<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
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
        $funcionarios = Funcionario::
        where('empresa_id', $this->user->empresa_id)
        ->orderBy('nome', 'asc')
        ->get();

        foreach($funcionarios as $f){
            foreach ($f->itensAlocados as $item) {
                $item->produto;
            }
        }

        return response()->json($funcionarios); 
    }

    public function store(Request $request)
    {
        try {
            $funcionario = Funcionario::create([
                'empresa_id' => $this->user->empresa_id,
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'celular' => $request->celular,
                'token_liberacao' => $request->token_liberacao
            ]);

            return response()->json($funcionario); 

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao salvar funcionario: ' . $e], 500);
        }

    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(['message' => 'funcionario excluído com sucesso']);
    }
}
