@extends('layouts.principal')
@section('titulo', 'Categorias — Sistema de Produtos')

@section('conteudo')
<div class="d-flex align-items-center justify-content-between page-header">
    <div>
        <h1><i class="bi bi-tags-fill me-2" style="color:#6366f1"></i>Categorias</h1>
        <p>{{ $categorias->count() }} categoria(s) cadastrada(s)</p>
    </div>
    <a href="{{ route('categorias.criar') }}" class="btn-primario" id="btn-nova-categoria">
        <i class="bi bi-plus-lg"></i> Nova Categoria
    </a>
</div>

<div class="card-custom">
    @if ($categorias->isEmpty())
        <div class="empty-state">
            <i class="bi bi-tags"></i>
            <p class="mb-1 fw-semibold">Nenhuma categoria cadastrada</p>
            <p class="small">Clique em "Nova Categoria" para começar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Produtos</th>
                        <th>Criado em</th>
                        <th style="width:140px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td class="text-muted small">{{ $categoria->id }}</td>
                        <td class="fw-semibold">{{ $categoria->nome }}</td>
                        <td class="text-muted">
                            {{ $categoria->descricao ? Str::limit($categoria->descricao, 60) : '—' }}
                        </td>
                        <td>
                            <span class="badge-categoria">{{ $categoria->produtos_count }} produto(s)</span>
                        </td>
                        <td class="text-muted small">{{ $categoria->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('categorias.editar', $categoria->id) }}"
                                   class="btn-editar" id="btn-editar-categoria-{{ $categoria->id }}">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form method="POST"
                                      action="{{ route('categorias.excluir', $categoria->id) }}"
                                      onsubmit="return confirm('Excluir a categoria \'{{ addslashes($categoria->nome) }}\'? Os produtos vinculados também serão removidos.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-excluir"
                                            id="btn-excluir-categoria-{{ $categoria->id }}">
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
