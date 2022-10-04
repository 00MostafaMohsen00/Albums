<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\Albumcontroller::class,'index'])->name('index')->middleware("auth");

Route::group(["prefix"=>"/album","middleware"=>"auth"],function () {
    Route::get('/create', [App\Http\Controllers\Albumcontroller::class,'create'])->name('album.create');
    Route::post('/save', [App\Http\Controllers\Albumcontroller::class,'save'])->name('album.save');
    Route::get('/edit/{id}', [App\Http\Controllers\Albumcontroller::class,'edit'])->name('album.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Albumcontroller::class,'update'])->name('album.update');
    Route::get('/delete/attach/{id}', [App\Http\Controllers\Albumcontroller::class,'delete_attach'])->name('attach.delete');
    Route::get('/delete/album/{id}', [App\Http\Controllers\Albumcontroller::class,'delete'])->name('album.delete');
    Route::post('/move/delete/album/{id}', [App\Http\Controllers\Albumcontroller::class,'move_delete'])->name('move.delete.album');


 });
