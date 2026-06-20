<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listar()
    {
        $categorias = Categoria::withCount('produtos')->orderBy('nome')->get();
        return view('categorias.listar', compact('categorias'));
    }

    public function criar()
    {
        return view('categorias.criar');
    }

    public function salvar(Request $requisicao)
    {
        $requisicao->validate([
            'nome'      => 'required|max:100',
            'descricao' => 'nullable|string',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.max'      => 'O nome não pode ter mais de 100 caracteres.',
        ]);

        Categoria::create($requisicao->only('nome', 'descricao'));

        return redirect()->route('categorias.listar')
            ->with('sucesso', 'Categoria criada com sucesso!');
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.editar', compact('categoria'));
    }

    public function atualizar(Request $requisicao, $id)
    {
        $requisicao->validate([
            'nome'      => 'required|max:100',
            'descricao' => 'nullable|string',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.max'      => 'O nome não pode ter mais de 100 caracteres.',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($requisicao->only('nome', 'descricao'));

        return redirect()->route('categorias.listar')
            ->with('sucesso', 'Categoria atualizada com sucesso!');
    }

    public function excluir($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.listar')
            ->with('sucesso', 'Categoria excluída com sucesso!');
    }
}
