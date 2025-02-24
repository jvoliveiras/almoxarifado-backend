<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
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
        $categorias = Categoria::
        where('empresa_id', $this->user->empresa_id)
        ->get();

        return response()->json($categorias); 
    }

    public function store(Request $request)
    {
        try {
            $categoria = Categoria::create([
                'empresa_id' => $this->user->empresa_id,
                'nome' => $request->nome,
            ]);

            return response()->json($categoria); 

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao salvar categoria: ' . $e], 500);
        }

    }
}
