<?php

namespace Database\Factories;

use App\Models\IpRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IpRecord>
 */
class IpRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'label' => $this->faker->word(),
            'comment' => $this->faker->sentence(),
            'created_by' => $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
