<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name =  $this->faker->words(2,true);

        return [
            'name' => $this->faker->words(2,true),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
