<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand_number = $this->faker->numberBetween(1, 500);
        $rand_post = Post::find($rand_number);
        $title = 'http://127.0.0.1:8000/storage/post-images/'.$rand_post->id;
        return [
            'post_id' => $rand_post,
            'title' => $title,
        ];
    }
}
