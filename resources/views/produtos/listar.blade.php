@extends('layouts.principal')
@section('titulo', 'Produtos — Sistema de Produtos')

@section('conteudo')
<div class="d-flex align-items-center justify-content-between page-header">
    <div>
        <h1><i class="bi bi-grid-3x3-gap-fill me-2" style="color:#6366f1"></i>Produtos</h1>
        <p>{{ $produtos->count() }} produto(s) encontrado(s)</p>
    </div>
    <a href="{{ route('produtos.criar') }}" class="btn-primario" id="btn-novo-produto">
        <i class="bi bi-plus-lg"></i> Novo Produto
    </a>
</div>

{{-- Filtros / Busca --}}
<div class="card-custom p-3 mb-4">
    <form method="GET" action="{{ route('produtos.listar') }}" id="form-filtro-produtos">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label for="busca" class="form-label-custom">Buscar por nome</label>
                <div class="input-group">
                    <span class="input-group-text" style="border-radius:10px 0 0 10px; border:1.5px solid #e2e8f0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           id="busca"
                           name="busca"
                           class="form-control form-control-custom"
                           style="border-radius:0 10px 10px 0; border-left:0"
                           value="{{ request('busca') }}"
                           placeholder="Digite o nome do produto...">
                </div>
            </div>
            <div class="col-md-4">
                <label for="categoria_id" class="form-label-custom">Filtrar por categoria</label>
                <select id="categoria_id" name="categoria_id"
                        class="form-select form-control-custom form-select-custom">
                    <option value="">Todas as categorias</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}"
                            {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn-primario flex-fill" id="btn-filtrar">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
                @if(request('busca') || request('categoria_id'))
                    <a href="{{ route('produtos.listar') }}" class="btn-secundario" id="btn-limpar-filtro">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

{{-- Tabela de Produtos --}}
<div class="card-custom">
    @if ($produtos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-box-seam"></i>
            <p class="mb-1 fw-semibold">Nenhum produto encontrado</p>
            <p class="small">
                @if(request('busca') || request('categoria_id'))
                    Tente ajustar os filtros de busca.
                @else
                    Clique em "Novo Produto" para começar.
                @endif
            </p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th style="width:70px">Imagem</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Criado em</th>
                        <th style="width:140px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>
                            @if ($produto->imagem)
                                <img src="{{ asset('storage/' . $produto->imagem) }}"
                                     alt="{{ $produto->nome }}"
                                     class="img-produto-thumb">
                            @else
                                <div class="sem-imagem"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $produto->nome }}</div>
                            @if($produto->descricao)
                                <div class="text-muted small">{{ Str::limit($produto->descricao, 50) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge-categoria">{{ $produto->categoria->nome }}</span>
                        </td>
                        <td class="fw-semibold" style="color:#059669">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </td>
                        <td class="text-muted small">{{ $produto->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('produtos.editar', $produto->id) }}"
                                   class="btn-editar" id="btn-editar-produto-{{ $produto->id }}">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form method="POST"
                                      action="{{ route('produtos.excluir', $produto->id) }}"
                                      onsubmit="return confirm('Excluir o produto \'{{ addslashes($produto->nome) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-excluir"
                                            id="btn-excluir-produto-{{ $produto->id }}">
                                        <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
