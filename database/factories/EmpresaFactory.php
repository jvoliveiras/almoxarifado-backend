<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresaFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->company, // Nome da empresa
            'cnpj' => $this->faker->numerify('##.###.###/####-##'), // CNPJ
            'logradouro' => $this->faker->streetAddress, // Logradouro
            'numero' => $this->faker->buildingNumber, // Número
            'complemento' => $this->faker->optional()->streetAddress, // Complemento
            'bairro' => $this->faker->word, // Bairro
            'cidade' => $this->faker->city, // Cidade
            'UF' => $this->faker->stateAbbr, // Estado (sigla)
            'fone' => $this->faker->phoneNumber, // Telefone
            'cep' => $this->faker->postcode, // CEP
            'email' => $this->faker->unique()->safeEmail, // E-mail
            'logo' => $this->faker->imageUrl(100, 100), // URL da logo
        ];
    }
}
