<?php

namespace Modules\Infrastructure\database\seeders\Infrastructure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\app\Models\Infrastructure;

class InfrastructureTableSeeder extends Seeder
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

        // Infrastructure::factory(rand(100, 500))->create();
    }
}
