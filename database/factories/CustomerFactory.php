<?php
/**
 * @copyright (c) 2023 ${PROJECT_NAME}
 * @author    Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date      2023-09-22 23:11
 */

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CustomerFactory extends Factory
{

    protected $model = Customer::class;


    public function definition(): array
    {
        return [
            'customername' => $this->faker->word(),

            'supplement' => $this->faker->word(),
            'address_id' => $this->faker->address(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
