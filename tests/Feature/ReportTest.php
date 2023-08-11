<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Report\app\Models\Report;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @void
     */
    use WithFaker;

    public function test_report_user_create()
    {
        $user = User::firstWhere('email', 'user@gmail.com');
        $res = $this->actingAs($user)->post(
            route('report.store'),
            [
                'title' => $this->faker()->sentence(),
            ]
        );

        $res->assertStatus(302);
    }

    public function test_report_user_update()
    {
        $user = User::firstWhere('email', 'user@gmail.com');
        $report = Report::query()->latest()->first();
        $res = $this->actingAs($user)->put(
            route('report.update', $report->id),
            [
                '_c2VuZGVy' => 'VXNlcg==',
                'title' => $this->faker()->sentence(),
            ]
        );

        $res->assertStatus(302);
    }

    public function test_report_user_delete()
    {
        $user = User::firstWhere('email', 'user@gmail.com');
        $report = Report::query()->latest()->first();
        $res = $this->actingAs($user)->delete(route('report.destroy', $report->id));

        $res->assertStatus(302);
    }

    public function test_report_admin_edit()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $report = Report::query()->latest()->first();
        $res = $this->actingAs($user)->put(
            route('report.update', $report->id),
            [
                '_c2VuZGVy' => 'U3VwZXIgQWRtaW4=',
                'status' => 'Accepted',
            ]
        );

        $res->assertStatus(302);
    }

    public function test_report_admin_delete()
    {
        $user = User::firstWhere('email', 'superadmin@gmail.com');
        $report = Report::query()->latest()->first();
        $res = $this->actingAs($user)->delete(route('report.destroy', $report->id));

        $res->assertStatus(302);
    }
}
