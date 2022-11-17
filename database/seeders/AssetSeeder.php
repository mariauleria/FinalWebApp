<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asset::create([
            'serial_number' => 'SN1234',
            'status' => 'in storage',
            'brand' => 'Canon',
            'assigned_location' => 'Prodi DKV Lt.6',
            'current_location' => 'Prodi DKV Lt.6',
            'division_id' => 3,
            'asset_category_id' => 1
        ]);
    }
}
