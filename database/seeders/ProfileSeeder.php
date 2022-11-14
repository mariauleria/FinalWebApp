<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => '1',
            'binusianid' => 'BN0014352432',
            'phone' => '082543356234',
            'address' => 'Jl. Everywhere No.110',
            'division_id' => '3',
            'role_id' => '1'
        ]);

        Profile::create([
            'user_id' => '2',
            'binusianid' => 'BN3452523443',
            'phone' => '083543665654',
            'address' => 'Jl. Elsewhere No.13',
            'division_id' => '3',
            'role_id' => '1'
        ]);

        Profile::create([
            'user_id' => '3',
            'binusianid' => 'BN8345345865',
            'phone' => '081345634543',
            'address' => 'Jl. Panjaitan No.56',
            'division_id' => '3',
            'role_id' => '3'
        ]);

        Profile::create([
            'user_id' => '4',
            'binusianid' => 'BN835638546',
            'phone' => '08145635438',
            'address' => 'Jl. Sunda No.5',
            'division_id' => '3',
            'role_id' => '4'
        ]);

        //TO ASK: Should it be null?? or just move the role column to user table??
        Profile::create([
            'user_id' => '5',
            'binusianid' => null,
            'phone' => null,
            'address' => null,
            'division_id' => null,
            'role_id' => '5'
        ]);
    }
}
