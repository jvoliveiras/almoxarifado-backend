<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\ItemCompra;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class CompraController extends Controller
{

    protected $user = null;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $compras = Compra::
        where('empresa_id', $this->user->empresa_id)
        ->orderBy('updated_at', 'desc')
        ->get();

        return response()->json($compras); 
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $itens = $request->itensDaNota;

            $desconto = str_replace(',', '.', $request->desconto);
            $acrescimo = str_replace(',', '.', $request->acrescimo);

            $compra = Compra::create([
                'empresa_id' => $this->user->empresa_id,
                'usuario_id' => $this->user->id,
                'fornecedor_id' => $request->fornecedor_id,
                'valor_bruto' => $request->totalValor,
                'desconto' => $desconto,
                'acrescimo' => $acrescimo,
                'qtd_itens' => $request->totalItens,
                'numero_nf' => $request->numeroNF,
                'tipo_insercao' => 'Manual',
                'observacao' => $request->observacao,
                'data_recebimento' => Carbon::createFromFormat('d/m/Y', $request->dataRecebimento)->format('Y-m-d')
            ]);

            foreach($itens as $i){
                ItemCompra::create([
                    'compra_id' => $compra->id,
                    'produto_id' => $i['produto']->id,
                    'quantidade' => $i['quantidade'],
                    'valor_unitario' => $i['valor'],
                    'subtotal' => $i['subtotal']
                ]);
            }


            DB::commit();
            return response()->json($compra);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Erro ao salvar produto: ' . $e], 500);
        }

    }

    public function storePatrimonios($produto_id, $patrimonios){
        try {
            foreach($patrimonios as $pat){
                ProdutoPatrimonio::create([
                    'produto_id' => $produto_id,
                    'patrimonio' => $pat
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao salvar patrimonios: ' . $e], 500);
        }

    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso']);
    }
}
