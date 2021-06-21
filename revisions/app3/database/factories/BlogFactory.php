<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,5),
            'title' => $this->faker->sentence(8),
            'excerpt' => $this->faker->sentence(10),
            'body' => $this->faker->paragraph(30),
            'premium' => (bool)rand(0,1)
        ];
    }
}
