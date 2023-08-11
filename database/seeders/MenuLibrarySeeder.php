<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\MenuManagement\app\Models\MenuGroup;
use Modules\MenuManagement\app\Models\MenuItem;

class MenuLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = MenuGroup::firstWhere('name', 'General');

        MenuItem::create([
            'name' => 'Library',
            'icon' => 'fas fa-book',
            'route' => 'libraries.index',
            'permission_name' => 'dashboard_index',
            'menu_group_id' => $general->id,
            'posision' => 4,
        ]);
    }
}
