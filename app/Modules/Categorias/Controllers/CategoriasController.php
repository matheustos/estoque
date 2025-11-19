<?php

namespace App\Modules\Categorias\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Categorias\Services\CategoriasService;
use App\Retorno\Retorno;

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
            return Retorno::sucesso('Categoria cadastrada com sucesso!', $categoria, 200);
        }
        return Retorno::erro('Erro ao cadastrar categoria!', 500);
    }

    public function index(){
        $categorias = $this->categoriasService->buscarTodos();

        if($categorias){
            return Retorno::sucesso('Categorias encontradas:', $categorias, 200);
        }
        return Retorno::erro('Nenhuma categoria encontrada!', 404);
    }

    public function show($id){
        $categoria = $this->categoriasService->buscar($id);

        if($categoria){
            return Retorno::sucesso('Categoria encontrada:', $categoria, 200);
        }
        return Retorno::erro('Categoria não encontrada!', 404);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'empresa_id' => 'sometimes|integer|exists:empresas,id',
            'nome' => 'sometimes|string|max:255'
        ]);
        $categoria = $this->categoriasService->atualizarCategoria($validateData, $id);

        if($categoria){
            return Retorno::sucesso('Categoria atualizada com sucesso!', $categoria, 200);
        }
        return Retorno::erro('Erro ao atualizar categoria!', 500);
    }

    public function destroy($id){
        $categoria = $this->categoriasService->deletarCategoria($id);

        if($categoria){
            return Retorno::sucesso('Categoria deletada com sucesso!', null, 200);
        }
        return Retorno::erro('Erro ao deletar categoria!', 500);
    }
}