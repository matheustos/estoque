<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('permissoes')->insert([
            ['id' => 1, 'nome' => 'ver_dashboard', 'descricao' => 'Pode visualizar o dashboard'],
            ['id' => 2, 'nome' => 'criar_movimentacao', 'descricao' => 'Pode criar movimentações'],
            ['id' => 3, 'nome' => 'editar_movimentacao', 'descricao' => 'Pode editar movimentações'],
            ['id' => 4, 'nome' => 'deletar_movimentacao', 'descricao' => 'Pode deletar movimentações'],

            ['id' => 5, 'nome' => 'ver_produtos', 'descricao' => 'Pode visualizar produtos'],
            ['id' => 6, 'nome' => 'criar_produtos', 'descricao' => 'Pode criar produtos'],
            ['id' => 7, 'nome' => 'editar_produtos', 'descricao' => 'Pode editar produtos'],
            ['id' => 8, 'nome' => 'deletar_produtos', 'descricao' => 'Pode deletar produtos'],

            ['id' => 9, 'nome' => 'ver_fornecedores', 'descricao' => 'Pode visualizar fornecedores'],
            ['id' => 10, 'nome' => 'criar_fornecedores', 'descricao' => 'Pode criar fornecedores'],
            ['id' => 11, 'nome' => 'editar_fornecedores', 'descricao' => 'Pode editar fornecedores'],
            ['id' => 12, 'nome' => 'deletar_fornecedores', 'descricao' => 'Pode deletar fornecedores'],

            ['id' => 13, 'nome' => 'criar_relatorios', 'descricao' => 'Pode gerar relatórios'],
            ['id' => 14, 'nome' => 'exportar_relatorios', 'descricao' => 'Pode exportar relatórios'],

            ['id' => 15, 'nome' => 'exportar_backup', 'descricao' => 'Pode exportar backup de dados'],
            ['id' => 16, 'nome' => 'importar_backup', 'descricao' => 'Pode importar dados'],

            ['id' => 17, 'nome' => 'editar_perfil', 'descricao' => 'Pode editar dados do usuário'],
            ['id' => 18, 'nome' => 'editar_notificacoes', 'descricao' => 'Pode editar notificacoes'],
            ['id' => 19, 'nome' => 'editar_sistema', 'descricao' => 'Pode editar configuracoes do sistema'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
