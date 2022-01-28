<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BecaController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/iniciarSesion',[UsuarioController::class,'inicioSesionUsuario'])->name('iniciarSesion.usuario');
Route::post('/iniciarSesionAdmin',[UsuarioController::class,'iniciarSesionAdmin'])->name('iniciarSesion.admin');
Route::post('/registrarAlumno',[UsuarioController::class,'registrarAlumno'])->name('registrarAlumno');

Route::post('/registrarBeca',[BecaController::class,'registrarBeca'])->name('registarBeca');
Route::post('/postular',[BecaController::class,'postular'])->name('postular');
Route::post('/eliminarBeca',[BecaController::class,'eliminarBeca'])->name('eliminar.beca');
Route::post('/editarBeca',[BecaController::class,'editarbeca'])->name('editarbeca');
Route::post('/consultarBeca',[BecaController::class,'consultarBeca'])->name('consultarBeca');