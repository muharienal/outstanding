<?php

namespace Modules\Dashboard\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DashboardDatabaseSeeder extends Seeder
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
    }
}
