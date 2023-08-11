<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'nik' => '000000',
            'password' => Hash::make('000000'),
            'status' => 1,
        ]);

        // User::factory()->create([
        //     'name' => 'Other User',
        //     'email' => 'other.user@gmail.com',
        //     'nik' => '2305022',
        // ]);

        User::factory()->create([
            'name' => 'Denni Firmansyah',
            'nik' => '2105092',
            'password' => Hash::make('2105092'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Rheza Firmansyah',
            'nik' => '2125526',
            'password' => Hash::make('2125526'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'M Faqih Lukman Aji',
            'nik' => '2095145',
            'password' => Hash::make('2095145'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'M Yunianto',
            'nik' => '2084947',
            'password' => Hash::make('2084947'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Viki Kurniawan',
            'nik' => '2095143',
            'password' => Hash::make('2095143'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'A Tiar Maulana',
            'nik' => '2145980',
            'password' => Hash::make('2145980'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Digyo Niti Santoso',
            'nik' => '2145998',
            'password' => Hash::make('2145998'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Arik Setyo Wibowo',
            'nik' => '2095142',
            'password' => Hash::make('2095142'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Bima Arganata',
            'nik' => '2156264',
            'password' => Hash::make('2156264'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Oki Ardianda',
            'nik' => '2166569',
            'password' => Hash::make('2166569'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Hendnri Koreyanto',
            'nik' => 'K201429',
            'password' => Hash::make('K201429'),
            'status' => 1,
        ]);

        User::factory()->create([
            'name' => 'Pemal Kabogi',
            'nik' => 'K201680',
            'password' => Hash::make('K201680'),
            'status' => 1,
        ]);
    }
}
