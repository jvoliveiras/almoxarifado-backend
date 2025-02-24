<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class FuncionarioFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'cpf' => $this->faker->numberBetween(1,50),
            'celular' => $this->faker->numberBetween(1,50),
            'token_liberacao' => Hash::make('tokenLiberacao')
        ];
    }
}
