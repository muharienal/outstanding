<?php

namespace Modules\Setting\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Setting\app\Models\Setting;

class SettingSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $logo = [
            'sm' => 'logo-sm.png',
            'dark' => 'logo-dark.png',
            'light' => 'logo-light.png',
        ];

        $data = [
            'role' => 'User',
            'logo' => json_encode($logo),
        ];

        Setting::create([
            'name' => 'General',
            'data' => json_encode($data),
        ]);
    }
}
