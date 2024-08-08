<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rota para a listagem de usuários
Route::get('/users', [UserController::class, 'read'])->name('users.read');

// Rota para exibir o formulário de criação de um novo usuário
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Rota para armazenar um novo usuário no banco de dados
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Rota para exibir o formulário de edição de um usuário específico
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Rota para atualizar os dados de um usuário específico
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Rota para deletar um usuário específico
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Rota para carregar cidades dinamicamente usando a API do IBGE
Route::get('/cidades/{estado}', [UserController::class, 'getCidades']);

