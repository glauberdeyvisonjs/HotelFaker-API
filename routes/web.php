<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\RecuperarController;
use App\Http\Controllers\TesteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'principal'])->name('site.principal');
Route::post('/', [PrincipalController::class, 'login'])->name('site.principal');

Route::get('/cadastro', [CadastroController::class, 'cadastro'])->name('site.cadastro');
Route::post('/cadastro', [CadastroController::class, 'cadastro'])->name('site.cadastro');
Route::post('/cadastrar', [CadastroController::class, 'cadastrar'])->name('cadastrar');

Route::get('/recuperar-senha', [RecuperarController::class, 'view'])->name('site.recuperar');
Route::post('/recuperar', [RecuperarController::class, 'recuperar'])->name('recuperar');

Route::middleware('log.auth')->prefix('/app')->group(function(){
    Route::get('/home', [HomeController::class, 'logado'])->name('app.home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('app.sair');
});

//Route::redirect('/testredirect','/');

//Route::get('/testredirect', function(){
//    return redirect()->route('site.principal');
//});

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="/">Clique aqui<a/> para ir para a página inicial.';
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');