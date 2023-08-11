<?php

namespace Modules\PermissionManagement\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeederTableSeeder extends Seeder
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

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'general']);
        Permission::create(['name' => 'setting']);

        Permission::create(['name' => 'dashboard_index']);

        Permission::create(['name' => 'infrastructure_index']);
        Permission::create(['name' => 'infrastructure_store']);
        Permission::create(['name' => 'infrastructure_create']);
        Permission::create(['name' => 'infrastructure_show']);
        Permission::create(['name' => 'infrastructure_update']);
        Permission::create(['name' => 'infrastructure_destroy']);
        Permission::create(['name' => 'infrastructure_edit']);

        //add library
        Permission::create(['name' => 'library_index']);
        Permission::create(['name' => 'library_store']);
        Permission::create(['name' => 'library_create']);
        Permission::create(['name' => 'library_show']);
        Permission::create(['name' => 'library_update']);
        Permission::create(['name' => 'library_destroy']);
        Permission::create(['name' => 'library_edit']);

        //approve user
        Permission::create(['name' => 'approve_user']);

        Permission::create(['name' => 'menu_index']);
        Permission::create(['name' => 'menu_store']);
        Permission::create(['name' => 'menu_update']);
        Permission::create(['name' => 'menu_destroy']);

        Permission::create(['name' => 'menu_item_index']);
        Permission::create(['name' => 'menu_item_store']);
        Permission::create(['name' => 'menu_item_update']);
        Permission::create(['name' => 'menu_item_destroy']);

        Permission::create(['name' => 'permission_index']);
        Permission::create(['name' => 'permission_store']);
        Permission::create(['name' => 'permission_update']);
        Permission::create(['name' => 'permission_destroy']);

        Permission::create(['name' => 'report_index']);
        Permission::create(['name' => 'report_store']);
        Permission::create(['name' => 'report_update']);
        Permission::create(['name' => 'report_destroy']);

        Permission::create(['name' => 'role_index']);
        Permission::create(['name' => 'role_store']);
        Permission::create(['name' => 'role_update']);
        Permission::create(['name' => 'role_destroy']);

        Permission::create(['name' => 'route_index']);
        Permission::create(['name' => 'route_store']);
        Permission::create(['name' => 'route_update']);
        Permission::create(['name' => 'route_destroy']);

        Permission::create(['name' => 'setting_index']);
        Permission::create(['name' => 'setting_update']);

        Permission::create(['name' => 'user_index']);
        Permission::create(['name' => 'user_store']);

        Permission::create(['name' => 'user_profile_index']);
        Permission::create(['name' => 'user_validation_index']);
        Permission::create(['name' => 'user_validation_store']);
        Permission::create(['name' => 'user_update']);
        Permission::create(['name' => 'user_destroy']);
    }
}
