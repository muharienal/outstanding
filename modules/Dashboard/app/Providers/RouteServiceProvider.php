<?php

namespace Modules\Dashboard\app\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\View\Components\Breadcrumb;
use Modules\Dashboard\app\View\Components\Sidebar;
use Modules\Dashboard\app\View\Components\Topbar;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    // protected $moduleNamespace = 'Modules\Dashboard\app\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Blade::component('dashboard::topbar', Topbar::class);
        Blade::component('dashboard::sidebar', Sidebar::class);
        Blade::component('dashboard::breadcrumb', Breadcrumb::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web', 'auth', 'verified')
            // ->namespace($this->moduleNamespace)
            ->group(module_path('Dashboard', '/routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            // ->namespace($this->moduleNamespace)
            ->group(module_path('Dashboard', '/routes/api.php'));
    }
}
