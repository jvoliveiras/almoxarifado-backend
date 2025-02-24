<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'estoque_total' => $this->faker->numberBetween(1,50),
            'estoque_atual' => $this->faker->numberBetween(1,50),
            'imagem' => $this->faker->imageUrl(100, 100),
            'unidade' => 'UN',
            'referencia' => $this->faker->word,
            'ativo' => 1
        ];
    }
}
