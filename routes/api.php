<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Controller,AuthController,PacienteController,ProfissionalController,ConsultaController,ProntuarioController};

Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login',[AuthController::class,'login']);
Route::get('/aluno',[Controller::class,'aluno']);

Route::middleware('auth:sanctum')->group(function(){
  Route::get('/me',[AuthController::class,'me']);
  Route::post('/auth/logout',[AuthController::class,'logout']);

  Route::apiResource('pacientes', PacienteController::class);
  Route::apiResource('profissionais', ProfissionalController::class);

  Route::get('prontuarios/paciente/{id}', [ProntuarioController::class,'porPaciente']);
  Route::apiResource('prontuarios', ProntuarioController::class)->only(['index','store','show']);

  Route::apiResource('consultas', ConsultaController::class)->only(['index','store','update','destroy','show']);
});
