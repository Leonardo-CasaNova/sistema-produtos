@extends('layouts.principal')
@section('titulo', 'Nova Categoria — Sistema de Produtos')

@section('conteudo')
<div class="page-header">
    <h1><i class="bi bi-plus-circle-fill me-2" style="color:#6366f1"></i>Nova Categoria</h1>
    <p>Preencha os campos abaixo para criar uma nova categoria.</p>
</div>

<div class="card-custom p-4" style="max-width:600px">
    <form method="POST" action="{{ route('categorias.salvar') }}" id="form-criar-categoria">
        @csrf

        <div class="mb-4">
            <label for="nome" class="form-label-custom">Nome <span class="text-danger">*</span></label>
            <input type="text"
                   id="nome"
                   name="nome"
                   class="form-control form-control-custom {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                   value="{{ old('nome') }}"
                   placeholder="Ex.: Eletrônicos"
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
                      rows="3"
                      placeholder="Descrição opcional da categoria...">{{ old('descricao') }}</textarea>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn-primario" id="btn-salvar-categoria">
                <i class="bi bi-check-lg"></i> Salvar Categoria
            </button>
            <a href="{{ route('categorias.listar') }}" class="btn-secundario" id="btn-cancelar-categoria">
                <i class="bi bi-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
