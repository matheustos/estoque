<?php
// 2025_10_27_000006_create_usuarios_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('papel_id')->nullable()->constrained('papeis')->nullOnDelete();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user'); // admin ou user
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('usuarios');
    }
};
