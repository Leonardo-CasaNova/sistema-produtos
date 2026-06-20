<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rota inicial
Route::get('/', [ProdutoController::class, 'listar'])->name('inicio');

// Categorias
Route::get('/categorias', [CategoriaController::class, 'listar'])->name('categorias.listar');
Route::get('/categorias/criar', [CategoriaController::class, 'criar'])->name('categorias.criar');
Route::post('/categorias/salvar', [CategoriaController::class, 'salvar'])->name('categorias.salvar');
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'editar'])->name('categorias.editar');
Route::put('/categorias/{id}/atualizar', [CategoriaController::class, 'atualizar'])->name('categorias.atualizar');
Route::delete('/categorias/{id}/excluir', [CategoriaController::class, 'excluir'])->name('categorias.excluir');

// Produtos
Route::get('/produtos', [ProdutoController::class, 'listar'])->name('produtos.listar');
Route::get('/produtos/criar', [ProdutoController::class, 'criar'])->name('produtos.criar');
Route::post('/produtos/salvar', [ProdutoController::class, 'salvar'])->name('produtos.salvar');
Route::get('/produtos/{id}/editar', [ProdutoController::class, 'editar'])->name('produtos.editar');
Route::put('/produtos/{id}/atualizar', [ProdutoController::class, 'atualizar'])->name('produtos.atualizar');
Route::delete('/produtos/{id}/excluir', [ProdutoController::class, 'excluir'])->name('produtos.excluir');
