<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker->name,
            'email' =>$this->faker->freeEmail(),
            'password' => Hash::make('password'),//to store hash word of password
            'remember_token' => Str::random(16),
        ];
    }
}
