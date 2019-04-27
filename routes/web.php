<?php

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

Route::get('/', function () {
    return view('Home');
});

Route::get('categoria', function () {
    return view('Categoria');
});


//routes controller

Route::resource('categorie', 'CategorieController')->except([
    'show', 'create', 'edit'
]);

Route::resource('movie', 'Moviecontroller')->except([
    'show', 'create', 'edit']);
