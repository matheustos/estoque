<?php 
namespace App\Modules\Estoque\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Estoque\Services\EstoquesService;
use Illuminate\Http\Request;
use App\Retorno\Retorno;

class EstoquesController extends Controller{
    protected $estoquesService;

    public function __construct(EstoquesService $estoquesService){
        $this->estoquesService = $estoquesService;
    }

    public function index(){
        $estoques = $this->estoquesService->buscarTodos();

        if($estoques){
            return Retorno::sucesso('Produtos encontrados:', $estoques, 200);
        }
        return Retorno::erro('Estoque vazio', 404);
    }

    public function show($id){
        $estoque = $this->estoquesService->buscarPorId($id);

        if($estoque){
            return Retorno::sucesso('Estoque encontrado:', $estoque, 200);
        }
        return Retorno::erro('Estoque não encontrado', 404);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'almoxarifado_id' => 'required|integer|exists:almoxarifados,id',
            'quantidade' => 'required|integer|max:255',
            'quantidade_minima' => 'required|integer|max:255'
        ]);

        date_default_timezone_set('America/Sao_Paulo'); // define o fuso horário
        $dataHora = date('Y-m-d H:i:s'); // formato: 2025-11-11 11:30:45

        $validateData['ultima_atualizacao'] = $dataHora;

        $estoque = $this->estoquesService->cadastrarEstoque($validateData);

        if($estoque){
            return Retorno::sucesso('Estoque cadastrado com sucesso!', $estoque, 201);
        }
        return Retorno::erro('Erro ao cadastrar estoque!', 500);
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'produto_id' => 'sometimes|integer|exists:produtos,id',
            'almoxarifado_id' => 'sometimes|integer|exists:almoxarifados,id',
            'quantidade' => 'sometimes|integer|max:255'
        ]);

        date_default_timezone_set('America/Sao_Paulo'); // define o fuso horário
        $dataHora = date('Y-m-d H:i:s'); // formato: 2025-11-11 11:30:45

        $validateData['ultima_atualizacao'] = $dataHora;

        $estoque = $this->estoquesService->atualizarEstoque($validateData, $id);

        if($estoque){
            return Retorno::sucesso('Estoque atualizado com sucesso!', $estoque, 200);
        }
        return Retorno::erro('Erro ao atualizar estoque!', 500);
    }

    public function destroy($id){
        $estoque = $this->estoquesService->deletarEstoque($id);

        if($estoque){
            return Retorno::sucesso('Estoque deletado com sucesso!', null, 200);
        }
        return Retorno::erro('Erro ao deletar estoque!', 500);
    }
}