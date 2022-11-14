<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(ProfileSeeder::class);

//        $this->call(PageSeeder::class);
//        $this->call(Role_page_mapping::class);
//        $this->call(AssetCategorySeeder::class);
//        $this->call(AssetSeeder::class);
    }
}
