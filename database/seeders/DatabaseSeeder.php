<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $empresas = Empresa::factory()->count(5)->create();

        foreach ($empresas as $empresa) {
            $categorias = Categoria::factory()->count(2)->create([
                'empresa_id' => $empresa->id,
            ]);

            User::factory()->count(2)->create([
                'empresa_id' => $empresa->id,
            ]);

            Funcionario::factory()->count(5)->create([
                'empresa_id' => $empresa->id,
            ]);

            foreach($categorias as $c){
                Produto::factory()->count(5)->create([
                    'empresa_id' => $empresa->id,
                    'categoria_id' => $c->id
                ]);
            }


        }
    }
}
