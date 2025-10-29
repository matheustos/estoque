<?php
// 2025_10_27_000010_create_estoque_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->foreignId('almoxarifado_id')->constrained('almoxarifados')->cascadeOnDelete();
            $table->integer('quantidade')->default(0);
            $table->dateTime('ultima_atualizacao')->nullable();
            $table->timestamps();
            $table->unique(['produto_id','almoxarifado_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('estoque');
    }
};
