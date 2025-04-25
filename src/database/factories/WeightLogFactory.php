<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1, // あとで上書きするのでOK
            'weight' => $this->faker->randomFloat(1, 40, 100),
            'date' => $this->faker->date(), // ← ここを修正！
            'calories' => $this->faker->numberBetween(1200, 2500),
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->optional()->sentence(),
        ];
    }
}
