<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'details' => $this->faker->sentence($nbWords = 4),
            'creator' => $this->faker->name,
            'price' => $this->faker->randomDigit(),
            'picture' => 'https://picsum.photos/500/500',
            'status' => $this->faker->numberBetween($min = 0, $max = 3),
            'owner_id' => User::factory(),
        ];
    }
}
