<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    public function definition()
    {
        return [
            // 'empresa_id' => \App\Models\Empresa::factory(),
            'nome' => $this->faker->word
        ];
    }
}
