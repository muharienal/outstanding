<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_profile()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $response = $this->actingAs($user)->get(route('user.profile.index'));

        $response->assertSeeText($user->name);
    }

    public function test_logout()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertStatus(302);
    }
}
