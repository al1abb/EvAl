<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //
            'user_id' => User::factory(),
            'estate_type' => $this->faker->randomElement(['new apartment', 'apartment', 'house-villa', 'office', 'garage']),
            'estate_city' => $this->faker->city(),
            'estate_area' => $this->faker->numberBetween($min = 10, $max = 500),
            'estate_description' => $this->faker->text(),
            'estate_price' => $this->faker->numberBetween($min = 50000, $max = 1000000),
            'estate_address' => $this->faker->address(),
            'estate_district' => $this->faker->sentence(),
            'estate_viewsTotal' => $this->faker->numberBetween($min = 10, $max = 100),
            'estate_viewsToday' => $this->faker->numberBetween($min = 0, $max = 10),
            'estate_roomCount' => $this->faker->numberBetween($min = 1, $max = 9),
            'estate_apartmentFloor' => $this->faker->numberBetween($min = 1, $max = 20),
            'estate_tradeType' => $this->faker->randomElement(['sell', 'rent']),
            'updated_at' => $this->faker->date(),
            'created_at' => $this->faker->date()
        ];
    }
}
