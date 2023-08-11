<?php

namespace Modules\Report\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Report\database\seeders\Report\ReportSeederTableSeeder;

class ReportDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ReportSeederTableSeeder::class);
    }
}
