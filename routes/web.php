<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('documents.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

    Route::middleware('role:uploader')->group(function () {
        Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    });

    Route::middleware('role:viewer')->group(function () {
        Route::get('/documents/{document}/view', [DocumentController::class, 'view'])->name('documents.view');
    });
});
