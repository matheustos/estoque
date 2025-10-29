<?php
// 2025_10_27_000009_create_produtos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->string('nome');
            $table->string('sku')->nullable()->index();
            $table->string('descricao')->nullable();
            $table->decimal('preco_custo', 12, 2)->default(0);
            $table->decimal('preco_venda', 12, 2)->default(0);
            $table->timestamps();
            $table->unique(['empresa_id','sku']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('produtos');
    }
};
