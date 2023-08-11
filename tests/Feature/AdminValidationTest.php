<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Modules\UserManagement\app\Models\Validation;
use Tests\TestCase;

class AdminValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_prepare()
    {
        $test1 = User::firstWhere('email', 'test1@gmail.com');
        $res = $this->actingAs($test1)->post(
            route('user.validation.store'),
            [
                'user_selfie' => UploadedFile::fake()->image(uniqid().'.png'),
                'user_card_id' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $test2 = User::firstWhere('email', 'test2@gmail.com');
        $res = $this->actingAs($test2)->post(
            route('user.validation.store'),
            [
                'user_selfie' => UploadedFile::fake()->image(uniqid().'.png'),
                'user_card_id' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $test3 = User::firstWhere('email', 'test3@gmail.com');
        $res = $this->actingAs($test3)->post(
            route('user.validation.store'),
            [
                'user_selfie' => UploadedFile::fake()->image(uniqid().'.png'),
                'user_card_id' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $this->assertTrue(true);
    }

    public function test_user_validation_valid()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');

        $res = $this->actingAs($user)->post(
            route(
                'user.validation.update',
                User::firstWhere('email', 'test@gmail.com')->id
            )
        );

        $res->assertSeeText('User has been verified successfully!');
    }

    public function test_user_validation_invalid_card_id()
    {
        $test1 = User::firstWhere('email', 'test1@gmail.com');
        $valid = Validation::firstWhere('user_id', $test1->id);

        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->delete(route('user.validation.destroy', $valid->id));

        $res->assertStatus(302);
    }

    public function test_user_validation_invalid_selfie()
    {
        $test2 = User::firstWhere('email', 'test2@gmail.com');
        $valid = Validation::firstWhere('user_id', $test2->id);

        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->delete(route('user.validation.destroy', $valid->id));

        $res->assertStatus(302);
    }

    public function test_user_validation_invalid_selfie_card_id()
    {
        $test3 = User::firstWhere('email', 'test3@gmail.com');
        $valid = Validation::firstWhere('user_id', $test3->id);

        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->delete(route('user.validation.destroy', $valid->id));

        $res->assertStatus(302);
    }
}
