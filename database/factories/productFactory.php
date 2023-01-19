<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this ->faker-> productName;

        return [
            'name' => $name ,
            'slug' =>Str::slug($name),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(500,500),
            'price' => $this->faker->randomFloat(1 ,1,499),
            'compare_price' => $this->faker->randomFloat(1 ,500,999),
            'category_id' => Category::inRandomorder()->first()->id,
            'featured' => rand(0,1),
            'store_id' => Store::inRandomorder()->first()->id,


        ];
    }
}
