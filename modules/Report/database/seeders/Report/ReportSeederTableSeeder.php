<?php

namespace Modules\Report\database\seeders\Report;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Report\app\Models\Report;

class ReportSeederTableSeeder extends Seeder
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

        // Report::factory(rand(100, 500))->create();
    }
}
