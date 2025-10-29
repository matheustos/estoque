<?php
// 2025_10_27_000005_create_papel_permissoes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('papel_permissoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('papel_id')->constrained('papeis')->cascadeOnDelete();
            $table->foreignId('permissao_id')->constrained('permissoes')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['papel_id','permissao_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('papel_permissoes');
    }
};
