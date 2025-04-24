<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollVoteController;

Auth::routes();

Route::get('/', [PollController::class, 'index'])->name('polls.index');
Route::get('/polls/create', [PollController::class, 'create'])->middleware('auth')->name('polls.create');
Route::post('/polls', [PollController::class, 'store'])->middleware('auth')->name('polls.store');
Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');
Route::post('/polls/vote', [PollVoteController::class, 'store'])->name('polls.vote');
Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->middleware('auth')->name('polls.destroy');

Route::get('/create-admin', function () {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password@123'),
    ]);
    return 'Usuário criado com sucesso!';
});
