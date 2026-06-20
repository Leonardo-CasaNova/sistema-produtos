<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $eletronicos  = Categoria::where('nome', 'Eletrônicos')->first();
        $alimentos    = Categoria::where('nome', 'Alimentos')->first();
        $vestuario    = Categoria::where('nome', 'Vestuário')->first();
        $casaDeco     = Categoria::where('nome', 'Casa & Deco')->first();

        $produtos = [
            // Eletrônicos
            ['nome' => 'Smartphone Galaxy A55',  'descricao' => 'Tela 6.6", 128GB, câmera 50MP.',         'preco' => 1899.90, 'categoria_id' => $eletronicos->id],
            ['nome' => 'Notebook Dell Inspiron', 'descricao' => 'Core i5, 16GB RAM, SSD 512GB.',           'preco' => 3499.00, 'categoria_id' => $eletronicos->id],
            ['nome' => 'Fone Bluetooth JBL',     'descricao' => 'Over-ear, cancelamento de ruído.',        'preco' =>  399.90, 'categoria_id' => $eletronicos->id],

            // Alimentos
            ['nome' => 'Café Especial 500g',     'descricao' => 'Grãos selecionados, torrada média.',      'preco' =>   49.90, 'categoria_id' => $alimentos->id],
            ['nome' => 'Kit Azeite Português',   'descricao' => 'Extra virgem, caixa com 2 garrafas.',     'preco' =>   89.90, 'categoria_id' => $alimentos->id],

            // Vestuário
            ['nome' => 'Camiseta Premium Pima',  'descricao' => 'Algodão Pima peruano, fit regular.',      'preco' =>  119.90, 'categoria_id' => $vestuario->id],
            ['nome' => 'Tênis Running Air',      'descricao' => 'Solado em borracha, palmilha ortopédica.','preco' =>  349.90, 'categoria_id' => $vestuario->id],

            // Casa & Deco
            ['nome' => 'Luminária de Mesa LED',  'descricao' => 'Regulagem de intensidade, USB-C.',        'preco' =>  159.90, 'categoria_id' => $casaDeco->id],
        ];

        foreach ($produtos as $dados) {
            Produto::firstOrCreate(['nome' => $dados['nome']], $dados);
        }
    }
}
