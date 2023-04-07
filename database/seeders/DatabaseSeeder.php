<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  \App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::factory(12)->create();
        // User::factory(10)->create();
    }
}
