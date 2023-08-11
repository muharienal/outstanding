<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('Laravel\Fortify\Http\Requests\LoginRequest', \App\Http\Requests\LoginRequest::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Login
        Fortify::loginView(fn () => view('auth.login'));

        // Register
        Fortify::registerView(fn () => view('auth.register'));

        // Forgot Password
        Fortify::requestPasswordResetLinkView(fn () => view('auth.passwords.email'));

        // Reset Password
        Fortify::resetPasswordView(fn ($request) => view('auth.passwords.reset', compact('request')));

        // Confirm Password
        Fortify::confirmPasswordView(fn () => view('auth.passwords.confirm'));

        // Verify Email
        Fortify::verifyEmailView(fn () => view('auth.verify'));

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::query()->firstWhere('nik', $request->nik);

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
