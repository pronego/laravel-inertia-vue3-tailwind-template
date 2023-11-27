<?php
/**
 * @copyright (c) 2023 ${PROJECT_NAME}
 * @author    Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date      2023-09-22 23:00
 */

namespace Database\Factories;

use App\Models\Cases;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CasesFactory extends Factory
{

    protected $model = Cases::class;


    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->randomNumber(),

            'category_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'name' => $this->faker->name(),
            'entry' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
