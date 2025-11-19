<?php

namespace App\Retorno;

class Retorno
{
    public static function sucesso($mensagem, $dados = [], $codigo)
    {
        return response()->json([
            'success' => true,
            'message' => $mensagem,
            'data' => $dados
        ], $codigo);
    }

    public static function erro($mensagem, $codigo)
    {
        return response()->json([
            'success' => false,
            'message' => $mensagem
        ], $codigo);
    }
}