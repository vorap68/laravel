<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText(rand(10, 20));
    return [
        'category_id' => rand(1, 4),
       'name' => $name,
        'description' =>  $this->faker->realText(rand(40, 50)),
        'code' => Str::slug($name),
        'price' => rand(100, 2000),
    ];
    }
}
