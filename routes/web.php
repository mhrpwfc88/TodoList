<?php

use App\Http\Controllers\halo\HaloController;
use App\Http\Controllers\Todo\TodoConroller;
use Illuminate\Support\Facades\Route;


Route::get('/', [TodoConroller::class, 'index'])->name('todo');
Route::post('/upload', [TodoConroller::class, 'store'])->name('todo.post');
Route::put('/update/{id}', [TodoConroller::class, 'update'])->name('todo.update');
Route::delete('/delete/{id}', [TodoConroller::class, 'destroy'])->name('todo.delete');
