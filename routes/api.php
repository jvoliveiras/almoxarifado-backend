<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoFuncionarioController;
use App\Http\Controllers\FornecedorController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('criaUsuarioMaster', [AuthController::class, 'criaUsuarioMaster']);

Route::middleware('auth:api')->group(function () {
    Route::get('validaToken', [AuthController::class, 'validaToken']);
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::resource('empresas', EmpresaController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('funcionarios', FuncionarioController::class);
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('produtoFuncionarios', ProdutoFuncionarioController::class);

    Route::post('produtoFuncionarios/devolucao', [ProdutoFuncionarioController::class, 'devolucao']);
    Route::get('produtoFuncionarios/gerarRelatorio/{id}', [ProdutoFuncionarioController::class, 'gerarRelatorio']);
    
});