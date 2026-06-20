<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function listar(Request $requisicao)
    {
        $consulta = Produto::with('categoria');

        if ($requisicao->filled('busca')) {
            $consulta->where('nome', 'like', '%' . $requisicao->busca . '%');
        }

        if ($requisicao->filled('categoria_id')) {
            $consulta->where('categoria_id', $requisicao->categoria_id);
        }

        $produtos   = $consulta->orderBy('nome')->get();
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.listar', compact('produtos', 'categorias'));
    }

    public function criar()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.criar', compact('categorias'));
    }

    public function salvar(Request $requisicao)
    {
        $dadosValidados = $requisicao->validate([
            'nome'         => 'required|max:150',
            'descricao'    => 'nullable|string',
            'preco'        => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagem'       => 'nullable|image|max:2048',
        ], [
            'nome.required'         => 'O nome do produto é obrigatório.',
            'preco.required'        => 'O preço é obrigatório.',
            'preco.numeric'         => 'O preço deve ser um número.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists'   => 'Categoria inválida.',
            'imagem.image'          => 'O arquivo deve ser uma imagem.',
            'imagem.max'            => 'A imagem não pode ter mais de 2MB.',
        ]);

        if ($requisicao->hasFile('imagem')) {
            $caminho = $requisicao->file('imagem')->store('produtos', 'public');
            $dadosValidados['imagem'] = $caminho;
        }

        Produto::create($dadosValidados);

        return redirect()->route('produtos.listar')
            ->with('sucesso', 'Produto criado com sucesso!');
    }

    public function editar($id)
    {
        $produto    = Produto::findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.editar', compact('produto', 'categorias'));
    }

    public function atualizar(Request $requisicao, $id)
    {
        $dadosValidados = $requisicao->validate([
            'nome'         => 'required|max:150',
            'descricao'    => 'nullable|string',
            'preco'        => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagem'       => 'nullable|image|max:2048',
        ], [
            'nome.required'         => 'O nome do produto é obrigatório.',
            'preco.required'        => 'O preço é obrigatório.',
            'preco.numeric'         => 'O preço deve ser um número.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists'   => 'Categoria inválida.',
            'imagem.image'          => 'O arquivo deve ser uma imagem.',
            'imagem.max'            => 'A imagem não pode ter mais de 2MB.',
        ]);

        $produto = Produto::findOrFail($id);

        if ($requisicao->hasFile('imagem')) {
            // Apaga imagem antiga
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $caminho = $requisicao->file('imagem')->store('produtos', 'public');
            $dadosValidados['imagem'] = $caminho;
        }

        $produto->update($dadosValidados);

        return redirect()->route('produtos.listar')
            ->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function excluir($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()->route('produtos.listar')
            ->with('sucesso', 'Produto excluído com sucesso!');
    }
}
