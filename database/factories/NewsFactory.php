<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::where('email', 'like', '%example.%')->get()->random()->id,
            'name' => 'test ' . $this->faker->unique()->word(),
            'body' => $this->faker->text(200),
            'published' => $this->faker->boolean()
        ];
    }
}
