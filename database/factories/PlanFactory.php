<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(1000, 10000),
            'type_id' => $this->faker->randomKey(Plan::TYPE_IDS),
            'trial_in_days' => $this->faker->boolean ? $this->faker->numberBetween(1, 30) : null,
        ];
    }
}
