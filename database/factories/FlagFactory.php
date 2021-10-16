<?php

namespace Database\Factories;

use App\Models\Flag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'post_id' => Post::all()->random(),
            'flag_reason' => $this->faker->text(),
            'updated_at' => $this->faker->date(),
            'created_at' => $this->faker->date()
        ];
    }
}
