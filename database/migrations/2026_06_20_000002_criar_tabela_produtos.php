<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $tabela) {
            $tabela->id();
            $tabela->string('nome', 150);
            $tabela->text('descricao')->nullable();
            $tabela->decimal('preco', 10, 2);
            $tabela->string('imagem')->nullable();
            $tabela->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $tabela->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
