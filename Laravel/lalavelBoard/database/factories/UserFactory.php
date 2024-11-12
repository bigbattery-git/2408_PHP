<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-5 years');
        return [
            'u_email' => $this->faker->unique()->safeEmail()
            ,'u_name' => $this->faker->name()          
            ,'u_password' => Hash::make('qwer1234')
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
