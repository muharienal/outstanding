<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Modules\Infrastructure\app\Models\Infrastructure;
use Tests\TestCase;

class InfrastrukturTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;

    public function test_infra_user_show()
    {
        $user = User::firstWhere('email', 'user@gmail.com');
        $infra = Infrastructure::query()->first();
        $response = $this->actingAs($user)->get(route('infrastructure.show', $infra->slug));

        $response->assertSeeText($infra->title);
    }

    public function test_infrastructure_admin_create()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->post(
            route('infrastructure.store'),
            [
                'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertStatus(302);
    }

    public function test_infrastructure_admin_except_thumbnail()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->post(
            route('infrastructure.store'),
            [
                'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                // 'thumbnail' => UploadedFile::fake()->image(uniqid() . '.png'),
            ]
        );

        $res->assertSessionHasErrors(['thumbnail']);
    }

    public function test_infrastructure_admin_except_title()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->post(
            route('infrastructure.store'),
            [
                // 'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['title']);
    }

    public function test_infrastructure_admin_except_content()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $res = $this->actingAs($user)->post(
            route('infrastructure.store'),
            [
                'title' => $this->faker()->sentence(),
                // 'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['body']);
    }

    public function test_infrastructure_admin_edit()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $infra = Infrastructure::query()->first();
        $res = $this->actingAs($user)->put(
            route('infrastructure.update', $infra->id),
            [
                'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertStatus(302);
    }

    public function test_infrastructure_admin_excep_thumbnain()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $infra = Infrastructure::query()->first();
        $res = $this->actingAs($user)->put(
            route('infrastructure.update', $infra->id),
            [
                'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                // 'thumbnail' => UploadedFile::fake()->image(uniqid() . '.png'),
            ]
        );

        $res->assertStatus(302);
    }

    public function test_infrastructure_admin_excep_title()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $infra = Infrastructure::query()->first();
        $res = $this->actingAs($user)->put(
            route('infrastructure.update', $infra->id),
            [
                // 'title' => $this->faker()->sentence(),
                'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['title']);
    }

    public function test_infrastructure_admin_excep_content()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $infra = Infrastructure::query()->first();
        $res = $this->actingAs($user)->put(
            route('infrastructure.update', $infra->id),
            [
                'title' => $this->faker()->sentence(),
                // 'body' => $this->faker()->paragraph(),
                'thumbnail' => UploadedFile::fake()->image(uniqid().'.png'),
            ]
        );

        $res->assertSessionHasErrors(['body']);
    }
}
