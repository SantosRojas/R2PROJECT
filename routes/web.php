<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/portafolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portafolio/{project:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::redirect('/portfolio', '/portafolio', 301);
