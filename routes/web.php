<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', static fn () => view('welcome'))->name('welcome');
Route::get('/settings', static fn () => view('settings'))->name('settings');
Route::get('/pipelines', static fn () => view('pipelines'))->name('pipelines');
