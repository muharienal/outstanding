<?php

namespace Modules\PermissionManagement\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\PermissionManagement\app\Models\Route;

class RouteSeederTableSeeder extends Seeder
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

        Route::create(['route' => 'dashboard.index', 'permission_name' => 'dashboard_index']);

        Route::create(['route' => 'infrastructure.index', 'permission_name' => 'infrastructure_index']);
        Route::create(['route' => 'infrastructure.store', 'permission_name' => 'infrastructure_store']);
        Route::create(['route' => 'infrastructure.create', 'permission_name' => 'infrastructure_create']);
        Route::create(['route' => 'infrastructure.show', 'permission_name' => 'infrastructure_show']);
        Route::create(['route' => 'infrastructure.update', 'permission_name' => 'infrastructure_update']);
        Route::create(['route' => 'infrastructure.destroy', 'permission_name' => 'infrastructure_destroy']);
        Route::create(['route' => 'infrastructure.edit', 'permission_name' => 'infrastructure_edit']);

        //add library
        Route::create(['route' => 'library.index', 'permission_name' => 'library_index']);
        Route::create(['route' => 'library.store', 'permission_name' => 'library_store']);
        Route::create(['route' => 'library.create', 'permission_name' => 'library_create']);
        Route::create(['route' => 'library.show', 'permission_name' => 'library_show']);
        Route::create(['route' => 'library.update', 'permission_name' => 'library_update']);
        Route::create(['route' => 'library.destroy', 'permission_name' => 'library_destroy']);
        Route::create(['route' => 'library.edit', 'permission_name' => 'library_edit']);

        //approve user
        Route::create(['route' => 'approve.user', 'permission_name' => 'approve_user']);

        Route::create(['route' => 'menu.index', 'permission_name' => 'menu_index']);
        Route::create(['route' => 'menu.store', 'permission_name' => 'menu_store']);
        Route::create(['route' => 'menu.update', 'permission_name' => 'menu_update']);
        Route::create(['route' => 'menu.destroy', 'permission_name' => 'menu_destroy']);

        Route::create(['route' => 'menu.item.index', 'permission_name' => 'menu_item_index']);
        Route::create(['route' => 'menu.item.store', 'permission_name' => 'menu_item_store']);
        Route::create(['route' => 'menu.item.update', 'permission_name' => 'menu_item_update']);
        Route::create(['route' => 'menu.item.destroy', 'permission_name' => 'menu_item_destroy']);

        Route::create(['route' => 'permission.index', 'permission_name' => 'permission_index']);
        Route::create(['route' => 'permission.store', 'permission_name' => 'permission_store']);
        Route::create(['route' => 'permission.update', 'permission_name' => 'permission_update']);
        Route::create(['route' => 'permission.destroy', 'permission_name' => 'permission_destroy']);

        Route::create(['route' => 'report.index', 'permission_name' => 'report_index']);
        Route::create(['route' => 'report.store', 'permission_name' => 'report_store']);
        Route::create(['route' => 'report.update', 'permission_name' => 'report_update']);
        Route::create(['route' => 'report.destroy', 'permission_name' => 'report_destroy']);

        Route::create(['route' => 'role.index', 'permission_name' => 'role_index']);
        Route::create(['route' => 'role.store', 'permission_name' => 'role_store']);
        Route::create(['route' => 'role.update', 'permission_name' => 'role_update']);
        Route::create(['route' => 'role.destroy', 'permission_name' => 'role_destroy']);

        Route::create(['route' => 'route.index', 'permission_name' => 'route_index']);
        Route::create(['route' => 'route.store', 'permission_name' => 'route_store']);
        Route::create(['route' => 'route.update', 'permission_name' => 'route_update']);
        Route::create(['route' => 'route.destroy', 'permission_name' => 'route_destroy']);

        Route::create(['route' => 'setting.index', 'permission_name' => 'setting_index']);
        Route::create(['route' => 'setting.update', 'permission_name' => 'setting_update']);

        Route::create(['route' => 'user.index', 'permission_name' => 'user_index']);
        Route::create(['route' => 'user.store', 'permission_name' => 'user_store']);

        Route::create(['route' => 'user.profile.index', 'permission_name' => 'user_profile_index']);

        Route::create(['route' => 'user.validation.index', 'permission_name' => 'user_validation_index']);
        Route::create(['route' => 'user.validation.store', 'permission_name' => 'user_validation_store']);
        Route::create(['route' => 'user.update', 'permission_name' => 'user_update']);
        Route::create(['route' => 'user.destroy', 'permission_name' => 'user_destroy']);
    }
}
