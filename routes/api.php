<?php

use App\Http\Controllers\CollaboratorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [HomeController::class, 'login'])->name('site.login');

Route::prefix('/cadastro')->name('cadastro.')->group(function () {
    Route::post('/cadastrar', [UserController::class, 'store'])->name('store');
    Route::post('/sendMail', [UserController::class, 'sendMail'])->name('sendMail');
});

// Route::get('/recuperar-password', [RecuperarController::class, 'view'])->name('site.recuperar');

Route::prefix('/app')->name('app.')->group(function () {
    Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/list', [UserController::class, 'list'])->name('list.users');
    Route::get('/logout', [HomeController::class, 'logout'])->name('sair');
    Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/list/collaborators', [CollaboratorsController::class, 'list'])->name('list.collaborators');
    Route::post('/store/collaborators', [CollaboratorsController::class, 'store'])->name('store.collaborators');
    Route::get('/show/collaborators/{id}', [CollaboratorsController::class, 'show'])->name('show.collaborators');
    Route::post('/delete/collaborators/{id}', [CollaboratorsController::class, 'destroy'])->name('delete.collaborators');
});
