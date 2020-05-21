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

Route::get('/', 'Controller@index')->name('home');
    //rute
    Route::get('/rutaadd', 'Controller@rutaForm')->name('ruta.form'); //adauga
    Route::post('/rutaadd', 'Controller@addruta')->name('rutaadd'); //adauga
    Route::get('/ruta', 'Controller@getRuta')->name('ruta'); //pag rute
    Route::post('/rutaedit/{idruta}', 'Controller@editruta')->name('rutaedit'); //edit
    Route::get('/rutaedit/{idruta}', 'Controller@editrutaForm')->name('rutaedit.form');//edit 
    Route::get('/stergeruta','Controller@deleteruta');//delete
    //avion
    Route::get('/avioaneadd', 'Controller@avioaneForm')->name('avioane.form'); //adauga
    Route::post('/avioaneadd', 'Controller@addavioane')->name('avioaneadd'); //adauga
    Route::get('/avioane', 'Controller@getAvioane')->name('avioane'); //pag avion
    Route::post('/avioaneedit/{idavion}', 'Controller@editavioane')->name('avioaneedit'); //edit
    Route::get('/avioaneedit/{idavion}', 'Controller@editavioaneForm')->name('avioaneedit.form');//edit 
    Route::get('/stergeavioane','Controller@deleteavioane');//delete
   
    //angajati
    Route::get('/angajatieadd', 'Controller@angajatiForm')->name('angajati.form'); //adauga
    Route::post('/angajatiadd', 'Controller@addangajati')->name('angajatiadd'); //adauga
    Route::get('/angajati', 'Controller@getAngajati')->name('angajati'); //pag angajati
    Route::post('/angajatiedit/{idangajat}', 'Controller@editangajati')->name('angajatiedit'); //edit
    Route::get('/angajatiedit/{idangajat}', 'Controller@editangajatiForm')->name('angajatiedit.form');//edit 
    Route::get('/stergeangajati','Controller@deleteangajati');//delete
   
    // program
    Route::get('/programadd', 'Controller@programForm')->name('program.form'); //adauga
    Route::post('/programadd', 'Controller@addprogram')->name('programadd'); //adauga
    Route::get('/program', 'Controller@getProgram')->name('program'); //pag echipaje
    Route::post('/programedit/{idechipaj}', 'Controller@editprogram')->name('programedit'); //edit
    Route::get('/programedit/{idechipaj}', 'Controller@editprogramForm')->name('programedit.form');//edit 
    Route::get('/stergeprogram','Controller@deleteprogram');//delete
   
    // zboruri
    Route::get('/zboruriadd', 'Controller@zboruriForm')->name('zboruri.form'); //adauga
    Route::post('/zboruriadd', 'Controller@addzboruri')->name('zboruriadd'); //adauga
    Route::get('/zboruri', 'Controller@getZboruri')->name('zboruri'); //pag echipaje
    Route::post('/zboruriedit/{idzbor}', 'Controller@editzboruri')->name('zboruriedit'); //edit
    Route::get('/zboruriedit/{idzbor}', 'Controller@editzboruriForm')->name('zboruriedit.form');//edit 
    Route::get('/stergezboruri','Controller@deletezboruri');//delete
   


   
