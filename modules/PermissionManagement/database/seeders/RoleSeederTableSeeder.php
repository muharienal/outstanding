<?php

namespace Modules\PermissionManagement\database\seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeederTableSeeder extends Seeder
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

        $superadmin = Role::create(['name' => 'Super Admin']);
        $user = Role::create(['name' => 'User']);
        $draf = Role::create(['name' => 'Draf']);

        $superadmin->givePermissionTo(Permission::all());
        $superadmin->revokePermissionTo('report_store');

        $userPerm = [
            'general',
            'dashboard_index',
            'report_index',
            'report_store',
            'report_update',
            'user_profile_index',
            'infrastructure_index',
            'infrastructure_show',
            'user_validation_index',
            'user_validation_store',
        ];

        $user->givePermissionTo($userPerm);
        $draf->givePermissionTo(
            array_merge(
                $userPerm,
                [
                    'infrastructure_create',
                    'infrastructure_destroy',
                    'infrastructure_edit',
                    'infrastructure_index',
                    'infrastructure_show',
                    'infrastructure_store',
                    'infrastructure_update',
                ]
            )
        );

        foreach (User::all() as $user) {
            $user->assignRole('User');
        }

        User::firstWhere('nik', '000000')->syncRoles('Super Admin');
        User::firstWhere('nik', 'K201429')->syncRoles('Draf');
        User::firstWhere('nik', 'K201680')->syncRoles('Draf');
    }
}
