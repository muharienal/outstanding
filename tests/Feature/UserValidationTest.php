<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UserValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;

    public function test_register_ok()
    {
        $res = $this->post(
            route('register'),
            [
                'name' => $this->faker()->name(),
                'email' => $this->faker()->email(),
                'password' => 'Pa$$w0rd!',
                'password_confirmation' => 'Pa$$w0rd!',
            ]
        );

        $res->assertRedirect(route('dashboard.index'));
    }

    public function test_register_invalid_password()
    {
        $res = $this->post(
            route('register'),
            [
                'name' => $this->faker()->name(),
                'email' => $this->faker()->email(),
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $res->assertSessionHasErrors(['password']);
    }

    public function test_register_invalid_email()
    {
        $res = $this->post(
            route('register'),
            [
                'name' => $this->faker()->name(),
                'email' => 'email',
                'password' => 'Pa$$w0rd!',
                'password_confirmation' => 'Pa$$w0rd!',
            ]
        );

        $res->assertSessionHasErrors(['email']);
    }

    public function test_register_blank_name()
    {
        $res = $this->post(
            route('register'),
            [
                'name' => null,
                'email' => $this->faker()->email(),
                'password' => 'Pa$$w0rd!',
                'password_confirmation' => 'Pa$$w0rd!',
            ]
        );

        $res->assertSessionHasErrors(['name']);
    }

    public function test_user_validation_ok()
    {
        $user = User::firstWhere('email', 'test@gmail.com');
        $res = $this->actingAs($user)->post(
            route('user.validation.store'),
            [
                'user_selfie' => UploadedFile::fake()->image(uniqid().'.png'),
                'user_card_id' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertRedirect(route('dashboard.index'));
    }

    public function test_user_validation_no_selfie()
    {
        $user = User::firstWhere('email', 'test@gmail.com');

        $res = $this->actingAs($user)->post(
            route('user.validation.store'),
            [
                'user_card_id' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['user_selfie']);
    }

    public function test_user_validation_no_card_id()
    {
        $user = User::firstWhere('email', 'test@gmail.com');

        $res = $this->actingAs($user)->post(
            route('user.validation.store'),
            [
                'user_selfie' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['user_card_id']);
    }
}
