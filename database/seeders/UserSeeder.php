<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Anthony Steven',
            'email' => 'anthony.trimurti001@binus.ac.id',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'Joshua Wenata',
            'email' => 'joshua.sunarto@binus.ac.id',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'LB001',
            'email' => 'lb001@binus.edu',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'Maria Auleria',
            'email' => 'maria.auleria@binus.edu',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@dummy.co',
            'password' => bcrypt('12345')
        ]);
    }
}
