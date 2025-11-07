<?php

namespace App\Modules\Categorias\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Categorias\Services\CategoriasService;

class CategoriasController extends Controller{
    protected $categoriasService;

    public function __construct(CategoriasService $categoriasService){
        $this->categoriasService = $categoriasService;
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'empresa_id' => 'required|integer|exists:empresas,id',
            'nome' => 'required|string|max:255'
        ]);

        $categoria = $this->categoriasService->cadastrarCategoria($validateData);

        if($categoria){
            return response()->json([
                'success' => true, 'message' => 'Categoria cadastrada com sucesso!', 'data' => $categoria
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Erro ao cadastrar categoria!'
        ], 500);
    }

    public function index(){
        $categorias = $this->categoriasService->buscarTodos();

        if($categorias){
            return response()->json([
                'success' => true, 'message' => 'Categorias encontradas:', 'data' => $categorias
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Nenhuma catergoria encontrada!'
        ], 404);
    }

    public function show($id){
        $categoria = $this->categoriasService->buscar($id);

        if($categoria){
            return response()->json([
                'success' => true, 'message' => 'Categoria encontrada:', 'data' => $categoria
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Nenhuma catergoria encontrada!'
        ], 404);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'empresa_id' => 'sometimes|integer|exists:empresas,id',
            'nome' => 'sometimes|string|max:255'
        ]);
        $categoria = $this->categoriasService->atualizarCategoria($validateData, $id);

        if($categoria){
            return response()->json([
                'success' => true, 'message' => 'Categoria atualizada com sucesso!', 'data' => $categoria
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Erro ao atualizar categoria!'
        ], 500);
    }

    public function destroy($id){
        $categoria = $this->categoriasService->deletarCategoria($id);

        if($categoria){
            return response()->json([
                'success' => true, 'message' => 'Categoria deletada com sucesso!'
            ], 200);
        }
        return response()->json([
            'success' => false, 'message' => 'Erro ao deletar categoria!'
        ], 500);
    }
}