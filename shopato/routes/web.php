<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\CarrinhoController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/anuncio/{codigo}', [AnuncioController::class, 'show'])->name('anuncio.show');

Route::get('/loja/{id}', [LojaController::class, 'show'])->name('loja.show');

Route::get('/carrinho/adicionar/{codigo}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.store');

Route::get('/loja/{id}', [LojaController::class, 'show'])->name('loja.show');

Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/foto', [ProfileController::class, 'editFoto'])->name('profile.foto');
    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.foto.update');
    Route::get('/anunciar', [AnuncioController::class, 'create'])->name('anunciar');
    Route::post('/anunciar', [AnuncioController::class, 'store'])->name('anunciar.store');
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho');
    Route::get('/carrinho/adicionar/{codigo}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::get('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
});








