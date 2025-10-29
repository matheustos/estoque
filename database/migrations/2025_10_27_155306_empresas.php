<?php
// 2025_10_27_000001_create_empresas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamp('data_criacao')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('empresas');
    }
};
