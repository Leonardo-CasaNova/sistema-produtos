<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Eletrônicos',  'descricao' => 'Smartphones, computadores, TVs e acessórios tecnológicos.'],
            ['nome' => 'Alimentos',    'descricao' => 'Produtos alimentícios, bebidas e itens de mercearia.'],
            ['nome' => 'Vestuário',    'descricao' => 'Roupas, calçados e acessórios de moda.'],
            ['nome' => 'Casa & Deco',  'descricao' => 'Móveis, decoração e utensílios domésticos.'],
        ];

        foreach ($categorias as $dados) {
            Categoria::firstOrCreate(['nome' => $dados['nome']], $dados);
        }
    }
}
