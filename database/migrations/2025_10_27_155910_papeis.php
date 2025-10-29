<?php
// 2025_10_27_000004_create_papeis_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('papeis', function (Blueprint $table) {
            $table->id();
            // papel global (NULL) ou por empresa
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->cascadeOnDelete();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->timestamps();
            $table->unique(['empresa_id','nome']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('papeis');
    }
};
