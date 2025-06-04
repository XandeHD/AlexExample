<?php

namespace Database\Factories;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\Factory;

class SampleFactory extends Factory
{
    protected $model = Sample::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'code' => strtoupper($this->faker->unique()->bothify('SAMPLE-###')),
            'cost' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->numberBetween(0,1),
            'created_by' => 1, // Ou faker()->numberBetween(1, x) se tiver utilizadores
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
