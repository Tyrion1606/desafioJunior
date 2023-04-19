<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(1);
        $slug = ('slug'.$name);
        $price = $this->faker->randomFloat(2, 1, 1000);
        $special_price = $this->faker->optional(0.5)->randomFloat(2, 1, $price);    // make sure special prices is aways less than normal price
        $special_price_from = null;
        $special_price_to = null;
        if ($special_price != null){
            $special_price_from = $this->faker->date();
            $special_price_to = $this->faker->date();
        }
        return [
            'name' => $name,
            'slug' => Str::slug($slug),
            'price' => $price,
            'special_price' => $special_price,
            'special_price_from' => $special_price_from,
            'special_price_to' => $special_price_to,
            'is_active' => $this->faker->boolean(60),
        ];
    }
}
