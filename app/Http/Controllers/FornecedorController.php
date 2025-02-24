<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
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
        $fornecedores = Fornecedor::
        where('empresa_id', $this->user->empresa_id)
        ->orderBy('nome_fantasia', 'asc')
        ->get();

        return response()->json($fornecedores); 
    }

    public function store(Request $request)
    {
        try {
            $fornecedor = Fornecedor::create([
                'empresa_id' => $this->user->empresa_id,
                'cpf_cnpj' => $request->cpf_cnpj,
                'razao_social' => $request->razao_social,
                'nome_fantasia' => $request->nome_fantasia
            ]);

            return response()->json($fornecedor); 

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao salvar fornecedor: ' . $e], 500);
        }

    }
}
