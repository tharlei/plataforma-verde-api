<?php

use App\Http\Controllers\ResidueController;
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

Route::get('/', fn () => 'Plataforma Verde')->name('home');
Route::post('/residues', [ResidueController::class, 'store'])->name('residue.store');
