<?php
// 2025_10_27_000008_create_almoxarifados_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('almoxarifados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->timestamps();
            $table->unique(['empresa_id','nome']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('almoxarifados');
    }
};
