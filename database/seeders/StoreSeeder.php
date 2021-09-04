<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Store::factory()->count(7)->create();
    }
}
