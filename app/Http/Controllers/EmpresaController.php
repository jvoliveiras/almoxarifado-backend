<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
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
        try {
            if($this->user->empresa_id == 1){
                $empresas = Empresa::get();
        
                return response()->json($empresas);
            } else {
                return response()->json(['error' => 'Não Permitido'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao carregar empresas'], 500);
        }
    }

    public function store(Request $request){
        try {

            if($this->user->empresa_id == 1){
                $data = $request->all();
    
                $result = Empresa::create([
                    'nome' => $data['nomeEmpresa']
                ]);
    
                if($result){
                    User::create([
                        'empresa_id' => $result->id,
                        'name' => $data['nomeUsuario'],
                        'password' => bcrypt($data['senhaUsuario']),
                        'email' => $data['emailUsuario']
                     ]);
                }
     
                return response()->json($result);
            } else {
                return response()->json(['error' => 'Erro ao salvar empresa, not allowed'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao salvar empresa'], 500);
        }

    }
}
