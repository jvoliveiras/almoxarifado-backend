<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Empresa;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Registro de usuário
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    // Login do usuário
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return response()->json(compact('token'));
    }

    // Detalhes do usuário autenticado
    public function validaToken(){
        $user = JWTAuth::user(); 
        
        return response()->json($user);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function criaUsuarioMaster()
    {
        $empresas = Empresa::first();
        if(!$empresas){
            $empresaMaster =  Empresa::create([
                'nome' => 'ADM System'
            ]);

            $userMaster = User::create([
                'empresa_id' => $empresaMaster->id,
                'name' => 'User ADM',
                'password' => bcrypt('senha123'),
                'email' => 'victor7_oliveira@hotmail.com'
            ]);

            if($empresaMaster && $userMaster){
                return response()->json('Criado com sucesso');
            }else {
                return response()->json('Erro');
            }
        }
    }
}
