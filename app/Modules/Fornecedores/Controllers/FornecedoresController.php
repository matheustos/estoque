<?php
namespace App\Modules\Fornecedores\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Fornecedores\Services\FornecedoresService;

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
            return response()->json(['message' => 'Fornecedores Encontrados:', 'fornecedores' => $fornecedores], 200);
        }
        return response()->json(['message' => 'Nenhum fornecedor encontrado'], 404);
    }

    public function show($id){
        $fornecedor = $this->fornecedoresService->buscarFornecedor($id);
        if($fornecedor){
            return response()->json(['Fornecedor Encontrado:' => $fornecedor], 200);
        }
        return response()->json(['message' => 'Nenhum fornecedor encontrado'], 404);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telefone' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'compras' => 'nullable|integer',
            'status' => 'required|string|max:100'
        ]);

        $fornecedor = $this->fornecedoresService->cadastrarForncedores($validatedData);

        if($fornecedor){
            return response()->json(['message' => 'Fornecedor cadastrado com sucesso!', 'fornecedor' => $fornecedor], 200);
        }
        return response()->json(['message' => 'Erro ao cadastrar fornecedor!'], 500);
    }
}