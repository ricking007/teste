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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PessoaController@index')->name('index'); //grid de pessoas

Route::get('pessoa/grid', 'PessoaController@grid');
Route::get('pessoa/genero', 'PessoaController@genero');
Route::resource('pessoa', 'PessoaController');
Route::resource('pais', 'PaisController');
//Route::post('pessoa/store', 'PessoaController@store');
