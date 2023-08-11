<?php

namespace Modules\MenuManagement\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\MenuManagement\app\Models\MenuGroup;
use Modules\MenuManagement\app\Models\MenuItem;

class MenuSettingSeederTableSeeder extends Seeder
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

        $setting = MenuGroup::create([
            'name' => 'Setting',
            'permission_name' => 'setting',
            'posision' => 2,
        ]);

        MenuItem::create([
            'name' => 'General Setting',
            'icon' => 'fas fa-cogs',
            'route' => 'setting.index',
            'permission_name' => 'setting_index',
            'menu_group_id' => $setting->id,
            'posision' => 1,
        ]);

        MenuItem::create([
            'name' => 'User Management',
            'icon' => 'fas fa-users',
            'route' => 'user.index',
            'permission_name' => 'user_index',
            'menu_group_id' => $setting->id,
            'posision' => 2,
        ]);

        MenuItem::create([
            'name' => 'Menu Management',
            'icon' => 'fas fa-bars',
            'route' => 'menu.index',
            'permission_name' => 'menu_index',
            'menu_group_id' => $setting->id,
            'posision' => 3,
        ]);

        MenuItem::create([
            'name' => 'Route Management',
            'icon' => 'fas fa-link',
            'route' => 'route.index',
            'permission_name' => 'route_index',
            'menu_group_id' => $setting->id,
            'posision' => 4,
        ]);

        MenuItem::create([
            'name' => 'Role Management',
            'icon' => 'fas fa-user-shield',
            'route' => 'role.index',
            'permission_name' => 'role_index',
            'menu_group_id' => $setting->id,
            'posision' => 5,
        ]);

        MenuItem::create([
            'name' => 'Permission Management',
            'icon' => 'fas fa-shield-alt',
            'route' => 'permission.index',
            'permission_name' => 'permission_index',
            'menu_group_id' => $setting->id,
            'posision' => 6,
        ]);
    }
}
