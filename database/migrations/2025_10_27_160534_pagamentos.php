<?php
// 2025_10_27_000013_create_pagamentos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assinatura_id')->constrained('assinaturas')->cascadeOnDelete();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->decimal('valor', 12, 2);
            $table->dateTime('data_pagamento')->nullable();
            $table->enum('status', ['PAGO','PENDENTE','FALHOU','REEMBOLSADO'])->default('PENDENTE');
            $table->enum('metodo_pagamento', ['CARTAO','BOLETO','PIX'])->nullable();
            $table->string('gateway_transacao_id')->nullable();
            $table->timestamps();
            $table->index(['empresa_id','status','metodo_pagamento']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('pagamentos');
    }
};
