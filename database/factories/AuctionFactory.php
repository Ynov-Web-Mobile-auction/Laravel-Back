<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Auction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => Item::factory(),
            'duration' => Carbon::now()->add(rand(0, 365), 'days'),
            'status' => $this->faker->numberBetween($min = 0, $max = 2),
        ];
    }
}
