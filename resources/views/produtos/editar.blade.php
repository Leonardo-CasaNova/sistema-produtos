@extends('layouts.principal')
@section('titulo', 'Editar Produto — Sistema de Produtos')

@section('conteudo')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2" style="color:#6366f1"></i>Editar Produto</h1>
    <p>Atualize as informações do produto abaixo.</p>
</div>

<div class="card-custom p-4" style="max-width:680px">
    <form method="POST"
          action="{{ route('produtos.atualizar', $produto->id) }}"
          enctype="multipart/form-data"
          id="form-editar-produto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="form-label-custom">Nome <span class="text-danger">*</span></label>
            <input type="text"
                   id="nome"
                   name="nome"
                   class="form-control form-control-custom {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                   value="{{ old('nome', $produto->nome) }}"
                   maxlength="150"
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
                      rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-sm-6">
                <label for="preco" class="form-label-custom">Preço (R$) <span class="text-danger">*</span></label>
                <input type="number"
                       id="preco"
                       name="preco"
                       class="form-control form-control-custom {{ $errors->has('preco') ? 'is-invalid' : '' }}"
                       value="{{ old('preco', $produto->preco) }}"
                       step="0.01"
                       min="0"
                       required>
                @error('preco')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label for="categoria_id" class="form-label-custom">Categoria <span class="text-danger">*</span></label>
                <select id="categoria_id"
                        name="categoria_id"
                        class="form-select form-control-custom form-select-custom {{ $errors->has('categoria_id') ? 'is-invalid' : '' }}"
                        required>
                    <option value="">Selecione uma categoria...</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('categoria_id', $produto->categoria_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nome }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="imagem" class="form-label-custom">Imagem do Produto</label>

            @if ($produto->imagem)
                <div class="mb-2">
                    <p class="text-muted small mb-1">Imagem atual:</p>
                    <img src="{{ asset('storage/' . $produto->imagem) }}"
                         alt="{{ $produto->nome }}"
                         style="height:100px; border-radius:10px; object-fit:cover; border:2px solid #e2e8f0">
                </div>
            @endif

            <input type="file"
                   id="imagem"
                   name="imagem"
                   class="form-control form-control-custom {{ $errors->has('imagem') ? 'is-invalid' : '' }}"
                   accept="image/*"
                   onchange="previewImagem(this)">
            @error('imagem')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-2" id="preview-container" style="display:none">
                <p class="text-muted small mb-1">Nova imagem:</p>
                <img id="preview-img" src="" alt="Preview"
                     style="height:100px; border-radius:10px; object-fit:cover; border:2px solid #e2e8f0">
            </div>
            <div class="text-muted small mt-1">Deixe em branco para manter a imagem atual.</div>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn-primario" id="btn-atualizar-produto">
                <i class="bi bi-check-lg"></i> Atualizar Produto
            </button>
            <a href="{{ route('produtos.listar') }}" class="btn-secundario" id="btn-cancelar-edicao-produto">
                <i class="bi bi-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script>
function previewImagem(input) {
    const container = document.getElementById('preview-container');
    const img = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; container.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
