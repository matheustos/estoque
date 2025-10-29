<?php
// 2025_10_27_000002_create_planos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            // Configurações do plano (limites, features) conforme diagrama
            $table->json('features')->nullable();
            // Se desejar, pode incluir preço/duração:
            // $table->decimal('preco', 10, 2)->nullable();
            // $table->integer('duracao_dias')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('planos');
    }
};
