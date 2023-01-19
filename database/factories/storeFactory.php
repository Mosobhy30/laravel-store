<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\store>
 */
class storeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this ->faker-> words( 2 ,true);

        return [
            'name' => $name ,
            'slug' =>Str::slug($name),
            'description' => $this->faker->sentence(10),
            'logo_img' => $this->faker->imageUrl(300,300), 
            'cover_img' => $this->faker->imageUrl(800,600), 
        ];
    }
}
