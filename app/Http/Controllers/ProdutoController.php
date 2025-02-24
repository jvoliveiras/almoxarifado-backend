<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\ProdutoPatrimonio;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
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
        $produtos = Produto::
        where('empresa_id', $this->user->empresa_id)
        ->orderBy('nome', 'asc')
        ->get();

        foreach($produtos as $p){
            $p->patrimonios;
        }

        return response()->json($produtos); 
    }

    public function store(Request $request)
    {
        try {
            $produto = Produto::create([
                'empresa_id' => $this->user->empresa_id,
                'categoria_id' => $request->categoria_id,
                'nome' => $request->nome,
                'estoque_total' => $request->estoque_total,
                'estoque_atual' => $request->estoque_total,
                'unidade' => $request->unidade,
                'controla_patrimonio' => $request->controla_patrimonio,
                'referencia' => $request->referencia,
                'ativo' => $request->ativo,
                'imagem' => $request->imagem,
                'qtd_minima' => $request->qtd_minima,
                'qtd_excelente' => $request->qtd_excelente
            ]);

            if($request->controla_patrimonio){
                $this->storePatrimonios($produto->id, $request->patrimonios);
            }

            return response()->json($produto); 

        } catch (Exception $e) {
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
