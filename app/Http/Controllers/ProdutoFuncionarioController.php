<?php

namespace App\Http\Controllers;

use App\Helpers\StockMove;
use Illuminate\Http\Request;
use App\Models\ProdutoFuncionario;
use App\Models\ProdutoFuncionarioDev;
use App\Models\ProdutoPatrimonio;
use Illuminate\Support\Facades\Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ProdutoFuncionarioController extends Controller
{
    protected $user = null;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $produtos = $request->produtos;

            $codEmprestimo = $this->geraCodigoEmprestimo();

            foreach ($produtos as $p){
                $quantidade = str_replace(",", ".", $p['quantidade']);

                $patProd = null;
                if(isset($p['patrimonio'])){
                    $patProd = $p['patrimonio']['patrimonio'];

                    $this->alteraDisponibilidadePatrimonio($p['produto_id'], $patProd);
                }
                
                ProdutoFuncionario::create([
                    'codigo_emprestimo' => $codEmprestimo,
                    'produto_id' => $p['produto_id'],
                    'funcionario_id' => $request->funcionario_id,
                    'quantidade' => $quantidade,
                    'patrimonio_produto' => $patProd
                ]);

                $stockMove = new StockMove();
                $stockMove->diminuiEstoque($p['produto_id'], $quantidade);
            }

            DB::commit();

            return response()->json('sucesso', 200); 

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao salvar produto: ' . $e], 500);
        }

    }

    public function devolucao(Request $request)
    {
        try {

            DB::beginTransaction();

            $itensAlocados = $request->itensAlocados;

            foreach ($itensAlocados as $i){

                $itemBD = ProdutoFuncionario::find($i['id']);

                ProdutoFuncionarioDev::create([
                    'codigo_emprestimo' => $itemBD->codigo_emprestimo,
                    'item_id' => $itemBD->id,
                    'quantidade_devolvida' => $i['aDevolver'],
                    'data_devolucao' => date('Y-m-d H:i:s')
                ]);

                $itemBD->quantidade_devolvida = $itemBD->quantidade_devolvida + $i['aDevolver'];

                if($itemBD->quantidade_devolvida == $itemBD->quantidade){
                    $itemBD->devolvido = 1;
                    $itemBD->data_ultima_devolucao = date('Y-m-d H:i:s');
                }

                $itemBD->save();

                $patProd = null;
                if($i['patrimonio_produto']){
                    $patProd = $i['patrimonio_produto'];

                    $this->alteraDisponibilidadePatrimonio($i['produto_id'], $patProd);
                }

                $stockMove = new StockMove();
                $stockMove->aumentaEstoque($i['produto_id'], $i['aDevolver']);
            }

            DB::commit();

            return response()->json('sucesso', 200); 

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao salvar devolução: ' . $e], 500);
        }

    }

    public function gerarRelatorio($funcionario_id)
    {
        $data = [];

        $registrosEmprestimos = ProdutoFuncionario::
        where('funcionario_id', $funcionario_id)
        ->get();
    
        foreach ($registrosEmprestimos as $r) {
            $r->devolucoes;

            $data[$r->codigo_emprestimo][] = $r;
        }

        // return $data;
  
        $pdf = Pdf::loadView('relatorios.movimentacao_funcionario', compact('data'));
 
        return $pdf->download('relatorio_movimentacao_funcionario.pdf');
    }

    private function geraCodigoEmprestimo() {
        do {
            $codEmprestimo = random_int(1000000000, 9999999999);
            $jaExiste = ProdutoFuncionario::where('codigo_emprestimo', $codEmprestimo)->exists();
        } while ($jaExiste);
    
        return $codEmprestimo;
    }

    private function alteraDisponibilidadePatrimonio($produto_id, $patrimonio){
        $produtoPatrimonio = ProdutoPatrimonio::
        where('produto_id', $produto_id)
        ->where('patrimonio', $patrimonio)
        ->first();

        $produtoPatrimonio->disponivel = $produtoPatrimonio->disponivel ? false : true;
        $produtoPatrimonio->save();
    }
}
