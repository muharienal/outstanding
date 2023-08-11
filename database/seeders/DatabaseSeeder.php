<?php

namespace Database\Seeders;

use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\database\seeders\InfrastructureDatabaseSeeder;
use Modules\MenuManagement\database\seeders\MenuManagementDatabaseSeeder;
use Modules\PermissionManagement\database\seeders\PermissionManagementDatabaseSeeder;
use Modules\Report\database\seeders\ReportDatabaseSeeder;
use Modules\Setting\database\seeders\SettingDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /**
         * Core Seeder
         */
        $this->call(UserSeeder::class);

        /**
         * Module Seeder
         */
        $this->call(MenuManagementDatabaseSeeder::class);
        $this->call(PermissionManagementDatabaseSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(ReportDatabaseSeeder::class);
        $this->call(InfrastructureDatabaseSeeder::class);
        $this->call(MenuLibrarySeeder::class);
    }
}
