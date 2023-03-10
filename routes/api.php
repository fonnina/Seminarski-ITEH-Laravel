<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\IspitController;
use App\Http\Controllers\StudentController;
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

Route::post('prijava', [APIAuthController::class, 'prijava']);
Route::get('svistudenti', [StudentController::class, 'sviStudenti']);
Route::get('studentiuplate', [StudentController::class, 'studentiUplate']);
Route::delete('obrisistudenta/{id}', [StudentController::class, 'obrisiStudenta']);
Route::post('promenistatusuplate', [StudentController::class, 'promeniStatusUplate']);
Route::post('sacuvajstudenta', [StudentController::class, 'sacuvajStudenta']);
Route::post('pretragastudenata', [StudentController::class, 'pretragaStudenata']);
Route::get('ispiti', [IspitController::class, 'ispiti']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
