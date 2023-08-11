<?php

namespace Modules\PermissionManagement\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionManagementDatabaseSeeder extends Seeder
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

        $this->call(PermissionSeederTableSeeder::class);
        $this->call(RoleSeederTableSeeder::class);
        $this->call(RouteSeederTableSeeder::class);
    }
}
