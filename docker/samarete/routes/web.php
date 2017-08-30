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
    return view('welcome');
});

//ADMIN
Route::middleware('admin')->group(function(){
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/ruoli', 'AdminController@ruoli');
    Route::get('/admin/permessi', 'AdminController@permessi');
    Route::get('/admin/associazioni', 'AdminController@associazioni');

    Route::post('/admin/get-user', 'UserController@getUser')->middleware('ajax');
    Route::get('/admin/get-users', 'UserController@getUsers')->middleware('ajax');
    Route::post('/admin/get-ruolo', 'RuoloController@getRuolo')->middleware('ajax');
    Route::get('/admin/get-ruoli', 'RuoloController@getRuoli')->middleware('ajax');
    Route::post('/admin/get-permesso', 'PermessoController@getPermesso')->middleware('ajax');
    Route::get('/admin/get-permessi', 'PermessoController@getPermessi')->middleware('ajax');
    Route::post('/admin/get-associazione', 'AssociazioneController@getAssociazione')->middleware('ajax');
    Route::get('/admin/get-associazioni', 'AssociazioneController@getAssociazioni')->middleware('ajax');

    Route::get('/admin/get-ruoli-users', 'UserController@getRuoliUsers')->middleware('ajax');
    Route::get('/admin/get-permessi-ruoli', 'RuoloController@getPermessiRuoli')->middleware('ajax');

    Route::post('/admin/save-user', 'UserController@saveUser')->middleware('ajax');
    Route::post('/admin/save-ruolo', 'RuoloController@saveRuolo')->middleware('ajax');
    Route::post('/admin/save-permesso', 'PermessoController@savePermesso')->middleware('ajax');
    Route::post('/admin/save-associazione', 'AssociazioneController@saveAssociazione')->middleware('ajax');

    Route::post('/admin/toggle-user', 'UserController@toggleUser')->middleware('ajax');
    Route::post('/admin/toggle-ruolo', 'RuoloController@toggleRuolo')->middleware('ajax');
    Route::post('/admin/toggle-associazione', 'AssociazioneController@toggleAssociazione')->middleware('ajax');

    Route::post('/admin/delete-user', 'UserController@deleteUser')->middleware('ajax');
    Route::post('/admin/delete-ruolo', 'RuoloController@deleteRuolo')->middleware('ajax');
    Route::post('/admin/delete-permesso', 'PermessoController@deletePermesso')->middleware('ajax');
    Route::post('/admin/delete-associazione', 'AssociazioneController@deleteAssociazione')->middleware('ajax');

    Route::post('/admin/add-ruolo', 'UserController@addRuolo')->middleware('ajax');
    Route::post('/admin/add-permesso', 'RuoloController@addPermesso')->middleware('ajax');

    Route::post('/admin/revoke-ruolo', 'UserController@revokeRuolo')->middleware('ajax');
    Route::post('/admin/revoke-permesso', 'RuoloController@revokePermesso')->middleware('ajax');

    Route::post('/admin/users/check-username', 'UserController@checkUsername')->middleware('ajax');
    Route::post('/admin/ruolo/check-nome', 'RuoloController@checkNome')->middleware('ajax');
    Route::post('/admin/permesso/check-nome', 'PermessoController@checkNome')->middleware('ajax');
    Route::post('/admin/associazione/check-nome', 'AssociazioneController@checkNome')->middleware('ajax');
});
//ASSOCIAZIONI
Route::post('/associazione/save-logo', 'AssociazioneController@saveLogo');
Route::post('/associazione/get-logo', 'AssociazioneController@getLogo');

//FILES
Route::post('/file/upload', 'FileController@saveTmpFile')->middleware('ajax');
Route::post('/file/delete', 'FileController@deleteFile')->middleware('ajax');
Route::post('/file/delete-tmp', 'FileController@deleteTmpFile')->middleware('ajax');

//CHAT
Route::post('/chat/get-chat', 'ChatController@getChat')->middleware('ajax');
Route::post('/chat/save-chat', 'ChatController@saveChat')->middleware('ajax');
Route::post('/chat/save-message', 'ChatController@saveMessaggio')->middleware('ajax');
Route::post('/chat/delete-chat', 'ChatController@deleteChat')->middleware('ajax');

//EVENTI
Route::get('/eventi', 'EventoController@index');
Route::get('/eventi/view-evento', 'EventoController@viewEvento');
Route::get('/eventi/edit-evento', 'EventoController@editEvento');

Route::post('/eventi/get-evento', 'EventoController@getEvento')->middleware('ajax');
Route::get('/eventi/get-eventi', 'EventoController@getEventi')->middleware('ajax');
Route::post('/eventi/save-evento', 'EventoController@saveEvento')->middleware('ajax');
Route::post('/eventi/delete-evento', 'EventoController@deleteEvento')->middleware('ajax');
Route::post('/eventi/get-logo', 'EventoController@getLogo')->middleware('ajax');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
