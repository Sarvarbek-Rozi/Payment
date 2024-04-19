<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $regions = array_rand([4,10],1);

        $city_id = [4,10][$regions] == 4 ? fake()->numberBetween(1,8) : fake()->numberBetween(9,15);
        return [
            'name' => fake()->name(),
            'brand_id' => fake()->numberBetween(1,4),
            'region_id' => [4,10][$regions],
            'city_id' => $city_id,
        ];
    }
}
