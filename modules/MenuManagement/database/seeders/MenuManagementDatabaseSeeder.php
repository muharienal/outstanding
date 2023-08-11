<?php

namespace Modules\MenuManagement\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MenuManagementDatabaseSeeder extends Seeder
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

        $this->call(MenuGeneralSeederTableSeeder::class); // position 1
        $this->call(MenuSettingSeederTableSeeder::class); // position 2
    }
}
