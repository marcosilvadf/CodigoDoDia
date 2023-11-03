<?php

use App\Http\Controllers\DesignController;
use App\Http\Controllers\dicasController;
use App\Http\Controllers\UniversoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dicas.principal');
    //return view('Inicio.Inicio');
});

Route::group(['prefix' => 'dicas'], function () {
    Route::get('/', [App\Http\Controllers\DicasController::class, 'index'])->name('dicas.principal');
    Route::get('/post/{slug}', [App\Http\Controllers\DicasController::class, 'show'])->name('dicas.ver');
    Route::get('/novo', [App\Http\Controllers\DicasController::class, 'create'])->name('dicas.novo')->middleware('verificarUsuarioLogado');
    Route::post('/novo', [App\Http\Controllers\DicasController::class, 'store'])->name('dicas.novo.post');
    Route::post('/', [App\Http\Controllers\DicasController::class, 'salvarIdSession'])->name('dicas.salvar.id');
    Route::get('/lista', [App\Http\Controllers\DicasController::class, 'lista'])->name('dicas.lista')->middleware('verificarUsuarioLogado');
    Route::get('/editar', [App\Http\Controllers\DicasController::class, 'edit'])->name('dicas.edit')->middleware('verificarUsuarioLogado');
    Route::post('/editar', [App\Http\Controllers\DicasController::class, 'update'])->name('dicas.edit.post');
    Route::get('/deletar', [App\Http\Controllers\DicasController::class, 'destroy'])->name('dicas.delete')->middleware('verificarUsuarioLogado');
});

Route::group(['prefix' => 'criadores'], function () {
    Route::get('/', [App\Http\Controllers\CriadoresController::class, 'index'])->name('criadores.principal');
    Route::get('/post/{slug}', [App\Http\Controllers\CriadoresController::class, 'show'])->name('criadores.ver');
    Route::get('/novo', [App\Http\Controllers\CriadoresController::class, 'create'])->name('criadores.novo')->middleware('verificarUsuarioLogado');
    Route::post('/novo', [App\Http\Controllers\CriadoresController::class, 'store'])->name('criadores.novo.post');
    Route::post('/', [App\Http\Controllers\CriadoresController::class, 'salvarIdSession'])->name('criadores.salvar.id');
    Route::get('/lista', [App\Http\Controllers\CriadoresController::class, 'lista'])->name('criadores.lista')->middleware('verificarUsuarioLogado');
    Route::get('/editar', [App\Http\Controllers\CriadoresController::class, 'edit'])->name('criadores.edit')->middleware('verificarUsuarioLogado');
    Route::post('/editar', [App\Http\Controllers\CriadoresController::class, 'update'])->name('criadores.edit.post');
    Route::get('/deletar', [App\Http\Controllers\CriadoresController::class, 'destroy'])->name('criadores.delete')->middleware('verificarUsuarioLogado');
});

Route::group(['prefix' => 'universo'], function () {
    Route::get('/', [App\Http\Controllers\UniversoController::class, 'index']);
});

Route::group(['prefix' => 'design'], function () {
    Route::get('/', [App\Http\Controllers\DesignController::class, 'index'])->name('design.principal');
});

Route::group(['prefix' => 'usuario'], function () {
    Route::get('/', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuario.principal')->middleware('verificarUsuarioLogado');
    Route::get('/cadastrar', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuario.novo');
    Route::post('/cadastrar', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario.novo.post');
    Route::get('/login', [App\Http\Controllers\UsuarioController::class, 'login'])->name('usuario.login');
    Route::post('/login', [App\Http\Controllers\UsuarioController::class, 'logif'])->name('usuario.login.post');
    Route::get('/perfil', [App\Http\Controllers\UsuarioController::class, 'perfil'])->name('usuario.perfil')->middleware('verificarUsuarioLogado');
    Route::get('/deslogar', [App\Http\Controllers\UsuarioController::class, 'deslogar'])->name('usuario.deslogar');
    Route::get('/editar', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuario.edit')->middleware('verificarUsuarioLogado');
    Route::post('/editar', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuario.edit.post');
    Route::get('/deletar', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuario.delete')->middleware('verificarUsuarioLogado');
    Route::get('/recuperar', [App\Http\Controllers\UsuarioController::class, 'recuperar'])->name('usuario.recuperar');
    Route::post('/recuperar', [App\Http\Controllers\UsuarioController::class, 'mudarSenha'])->name('usuario.recuperar.post');
});