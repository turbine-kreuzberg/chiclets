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

const ROUTE_NAME_HOME = 'welcome';
const ROUTE_NAME_SETTINGS = 'settings';
const ROUTE_NAME_PIPELINES = 'pipelines';

Route::get('/', static fn () => view('welcome'))->name(ROUTE_NAME_HOME);
Route::get('/settings', static fn () => view('settings'))->name(ROUTE_NAME_SETTINGS);
Route::get('/pipelines', static fn () => view('pipelines'))->name(ROUTE_NAME_PIPELINES);
