<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(2, 4)),
            'price' => $this->faker->numberBetween(100, 9999),
            'store_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 10),
            'avatar' => 'https://i.pravatar.cc/150?img='.rand(10, 50),
            'description' => $this->faker->paragraph(rand(1, 3)),
        ];
    }
}
