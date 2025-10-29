<?php
// 2025_10_27_000011_create_movimentacoes_estoque_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('movimentacoes_estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->foreignId('almoxarifado_id')->constrained('almoxarifados')->cascadeOnDelete();
            $table->enum('tipo', ['ENTRADA','SAIDA','TRANSFERENCIA','AJUSTE']);
            $table->integer('quantidade');
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->dateTime('data_movimentacao')->useCurrent();
            $table->string('motivo')->nullable();
            $table->timestamps();
            $table->index(
                ['produto_id', 'almoxarifado_id', 'data_movimentacao'], 
                'estoque_prod_almox_data_idx'
            );
        });
    }
    public function down(): void {
        Schema::dropIfExists('movimentacoes_estoque');
    }
};
