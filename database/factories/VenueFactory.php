<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'address1' => $this->faker->secondaryAddress,
            'street' => $this->faker->streetName,
            'town' => $this->faker->city,
            'county' => 'Kerry',
            'eircode' => $this->faker->postcode,
            'website' => $this->faker->url,
            'user_id' => 5,
        ];
    }
}
