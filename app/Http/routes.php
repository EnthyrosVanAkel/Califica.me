<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LoginController@redir');
Route::get('login', 'LoginController@login');
Route::get('olvide', 'LoginController@olvide');
Route::post('login', 'LoginController@acceso');
Route::get('logout', 'LoginController@logout');

// Registration routes...
Route::get('register', 'LoginController@registrar');
Route::post('register', 'LoginController@registrado');


//::::::: BECARIO :::::::
Route::get('becario/home', 'BecarioController@index');
Route::get('becario/perfil', 'BecarioController@my_perfil');
Route::get('becario/perfil/edit', 'BecarioController@my_perfil_edit');
Route::patch('becario/perfil/edit/n', 'BecarioController@edit_n');
Route::patch('becario/perfil/edit/d', 'BecarioController@edit_d');
Route::patch('becario/perfil/edit/e', 'BecarioController@edit_e');
Route::patch('becario/perfil/edit/a', 'BecarioController@edit_a');
Route::patch('becario/perfil/edit/h', 'BecarioController@edit_h');
Route::patch('becario/perfil/edit/p', 'BecarioController@edit_p');


//LISTA BECARIOS
Route::get('becario/lista', 'BecarioController@list_becarios');
Route::get('becario/lista/{id}', 'BecarioController@show_becario');

//LISTA PROYECTOS
Route::get('becario/proyectos', 'BecarioController@list_proyectos');
Route::get('becario/proyectos/{id}', 'BecarioController@show_proyecto');
Route::get('becario/proyectos/{id}/edit', 'BecarioController@edit_proyecto');
Route::patch('becario/proyectos/{id}/edit/p', 'BecarioController@update_proyecto');
Route::patch('becario/proyectos/{id}/edit/r', 'BecarioController@subir_recursos');
Route::patch('becario/proyectos/{id}/edit/i', 'BecarioController@agregar_integrantes');

/// EVALUACION
Route::get('becario/evaluacion/mis_tareas', 'BecarioController@mis_tareas');
Route::post('becario/evaluacion/mis_tareas/t', 'BecarioController@subir_tarea');
Route::delete('becario/evaluacion/mis_tareas/{id}/b', 'BecarioController@borrar_tarea');
Route::get('becario/evaluacion/mis_proyectos', 'BecarioController@mis_proyectos');
Route::get('becario/evaluacion/mis_proyectos/{id}', 'BecarioController@proyecto_integrantes');
Route::get('becario/evaluacion/mis_proyectos/{p}/califica/{i}', 'BecarioController@preguntas');
Route::post('becario/evaluacion/mis_proyectos/{p}/califica/{i}/c', 'BecarioController@calificar');


//::::::: ADMIN :::::::
Route::get('admin/home', 'AdministradorController@index');

//LISTA BECARIOS
Route::get('admin/becarios', 'AdministradorController@list_becarios');
Route::post('admin/becarios/a', 'AdministradorController@alta_becario');
Route::put('admin/becarios/b', 'AdministradorController@baja_becario');
Route::get('admin/becarios/{id}', 'AdministradorController@show_becario');
Route::get('admin/becarios/{id}/editar', 'AdministradorController@editar_becario');
//EDITAR BECARIO 
Route::patch('admin/becarios/{id}/editar/n', 'AdministradorController@edit_n');
Route::patch('admin/becarios/{id}/editar/d', 'AdministradorController@edit_d');
Route::patch('admin/becarios/{id}/editar/e', 'AdministradorController@edit_e');
Route::patch('admin/becarios/{id}/editar/a', 'AdministradorController@edit_a');
Route::patch('admin/becarios/{id}/editar/h', 'AdministradorController@edit_h');
Route::patch('admin/becarios/{id}/editar/p', 'AdministradorController@edit_p');
// :::: CONTENIDOS :::::
Route::get('admin/contenido','AdministradorController@contenidos');
Route::post('admin/contenido/n','AdministradorController@agregar_noticia');
Route::post('admin/contenido/r','AdministradorController@agregar_recurso');
Route::post('admin/contenido/t','AdministradorController@agregar_tarea');
Route::post('admin/contenido/e','AdministradorController@agregar_equipo');


//LISTA PROYECTOS
Route::get('admin/proyectos', 'AdministradorController@list_proyectos');
Route::post('admin/proyectos/alta', 'AdministradorController@alta_proyecto');
Route::get('admin/proyectos/{id}', 'AdministradorController@show_proyecto');
Route::get('admin/proyectos/{id}/edit', 'AdministradorController@edit_proyecto');
Route::patch('admin/proyectos/{id}/edit/p', 'AdministradorController@update_proyecto');
Route::patch('admin/proyectos/{id}/edit/r', 'AdministradorController@subir_recursos');
Route::patch('admin/proyectos/{id}/edit/i', 'AdministradorController@agregar_integrantes');
Route::delete('admin/proyectos/{proyecto}/edit/i/{becario}', 'AdministradorController@quitar_integrante');
