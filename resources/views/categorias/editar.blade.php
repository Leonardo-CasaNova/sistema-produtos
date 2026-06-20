@extends('layouts.principal')
@section('titulo', 'Editar Categoria — Sistema de Produtos')

@section('conteudo')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2" style="color:#6366f1"></i>Editar Categoria</h1>
    <p>Atualize as informações da categoria abaixo.</p>
</div>

<div class="card-custom p-4" style="max-width:600px">
    <form method="POST"
          action="{{ route('categorias.atualizar', $categoria->id) }}"
          id="form-editar-categoria">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="form-label-custom">Nome <span class="text-danger">*</span></label>
            <input type="text"
                   id="nome"
                   name="nome"
                   class="form-control form-control-custom {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                   value="{{ old('nome', $categoria->nome) }}"
                   maxlength="100"
                   required
                   autofocus>
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="descricao" class="form-label-custom">Descrição</label>
            <textarea id="descricao"
                      name="descricao"
                      class="form-control form-control-custom"
                      rows="3">{{ old('descricao', $categoria->descricao) }}</textarea>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn-primario" id="btn-atualizar-categoria">
                <i class="bi bi-check-lg"></i> Atualizar Categoria
            </button>
            <a href="{{ route('categorias.listar') }}" class="btn-secundario" id="btn-cancelar-edicao-categoria">
                <i class="bi bi-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
