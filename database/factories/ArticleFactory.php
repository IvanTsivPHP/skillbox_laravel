<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::where('email', 'like', '%example.%')->get()->random()->id,
            'code' => 'test' . $this->faker->unique()->numberBetween(1, 1000),
            'name' => 'test ' . $this->faker->unique()->word(),
            'description' => $this->faker->text(50),
            'body' => $this->faker->text(200),
            'published' => $this->faker->boolean()
        ];
    }
}
