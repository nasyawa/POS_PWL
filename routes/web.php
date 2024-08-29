<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// proses list data kategori 
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori/list', [KategoriController::class, 'list']);

// proses detail data kategori dan tambah data kategori 
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);

// proses edit data kategori 
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);

// proses hapus data kategori 
Route::get('/kategori/{id}/confirm', [KategoriController::class, 'confirm']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
