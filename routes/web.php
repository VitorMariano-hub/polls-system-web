<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollVoteController;

Auth::routes();

Route::get('/', [PollController::class, 'index'])->name('polls.index');
Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');
Route::post('/polls/vote', [PollVoteController::class, 'store'])->name('polls.vote');
Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->middleware('auth')->name('polls.destroy');

// Rotas Administrativas
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminPollController::class, 'dashboard'])->name('dashboard');
        Route::patch('/polls/{poll}/verify', [\App\Http\Controllers\Admin\AdminPollController::class, 'toggleVerify'])->name('polls.verify');
        Route::delete('/polls/{poll}', [\App\Http\Controllers\Admin\AdminPollController::class, 'destroy'])->name('polls.destroy');
        
        // Criar enquete no contexto do painel protegido
        Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');
        Route::post('/polls', [PollController::class, 'store'])->name('polls.store');
    });

