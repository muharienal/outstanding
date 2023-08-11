<?php

namespace Modules\Infrastructure\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\database\seeders\Infrastructure\InfrastructureTableSeeder;

class InfrastructureDatabaseSeeder extends Seeder
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

        $this->call(InfrastructureTableSeeder::class);
    }
}
