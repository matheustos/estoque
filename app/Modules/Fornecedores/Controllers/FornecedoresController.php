<?php
namespace App\Modules\Fornecedores\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Fornecedores\Services\FornecedoresService;
use App\Retorno\Retorno;

class FornecedoresController extends Controller
{
    protected $fornecedoresService;

    public function __construct(FornecedoresService $fornecedoresService)
    {
        $this->fornecedoresService = $fornecedoresService;
    }

    public function index(){
        $fornecedores = $this->fornecedoresService->buscarTodosFornecedores();

        if($fornecedores){
            return Retorno::sucesso('Lista de Fornecedores', $fornecedores, 200);
        }
        return Retorno::erro('Nenhum fornecedor encontrado', 404);
    }

    public function filtrarFornecedores(){
        $fornecedores = $this->fornecedoresService->filtrarTodosFornecedores();

        return Retorno::sucesso('Filtro de Fornecedores', $fornecedores, 200);
    }

    public function show($id){
        $fornecedor = $this->fornecedoresService->buscarFornecedor($id);
        if($fornecedor){
            return Retorno::sucesso('Detalhes do Fornecedor', $fornecedor, 200);
        }
        return Retorno::erro('Fornecedor não encontrado', 404);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telefone' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'compras' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'favorito' => 'nullable|boolean'
        ]);

        $validatedData['status'] = $request->boolean('status');
        $validatedData['favorito'] = $request->boolean('favorito');

        $fornecedor = $this->fornecedoresService->cadastrarForncedores($validatedData);

        if($fornecedor){
            return Retorno::sucesso('Fornecedor cadastrado com sucesso!', $fornecedor, 200);
        }
        return Retorno::erro('Falha ao cadastrar fornecedor', 500);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|max:255',
            'telefone' => 'sometimes|string|max:255',
            'cidade' => 'sometimes|string|max:100',
            'compras' => 'sometimes|integer',
            'status' => 'sometimes|string|max:100'
        ]);

        $fornecedor = $this->fornecedoresService->updateFornecedor($validatedData, $id);

        if($fornecedor){
            return Retorno::sucesso('Fornecedor atualizado com sucesso!', $fornecedor, 200);
        }
        return Retorno::erro('Fornecedor não encontrado', 404);
    }

    public function destroy($id){
        $fornecedor = $this->fornecedoresService->deleteFornecedor($id);

        if(!$fornecedor){
            return Retorno::erro('Fornecedor não encontrado', 404);
        }
        return Retorno::sucesso('Fornecedor deletado com sucesso!', null, 200);
    }
}