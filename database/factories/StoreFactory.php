<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(2, 4)),
            'category' => $this->faker->numberBetween(1, 5),
            'avatar' => 'https://i.pravatar.cc/150?img='.rand(10, 50),
            'description' => $this->faker->paragraph(rand(2,3)),
        ];
    }
}
