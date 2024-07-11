<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfMergeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/pdf-merge', [PdfMergeController::class, 'index']);

Route::post('/agent-form-pdf-merge', [PdfMergeController::class, 'agent_form']);