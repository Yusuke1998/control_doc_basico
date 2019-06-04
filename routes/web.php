<?php

Route::get('/', function () {
	return redirect(route('login'));
});
Route::get('documentos',function(){
	return redirect(Route('dashboard'));
});
Route::get('reporte',function(){
	return view('reportes.document');
});
// Auth::routes();
// RUTAS DE ACCESO
	// Authentication Routes...
Route::get('acceder', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('acceder', 'Auth\LoginController@login');
Route::post('salir', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
Route::get('registrar', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrar', 'Auth\RegisterController@register');

	// Password Reset Routes...
Route::get('contraseña/resetear', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('contraseña/correo', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('contraseña/resetear/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('contraseña/resetear', 'Auth\ResetPasswordController@reset');
// RUTAS DE ACCESO

Route::get('/home', 'HomeController@index')->name('home');
Route::get('Direccion-de-Informatica',function(){
	return [
		'Autor'=>
		[
			'nombre'=>'Jhonny Perez',
			'correo'=>
			[
				['jhperez@unerg.edu.ve'],
				['jhonnyjose1998@gmail.com']
			],
		],
		'Sistema'=>
		[
			['estado'=>'inicio','fecha'=>'22/05/2019'],
			['estado'=>'Finalizado','fecha'=>'04/06/2019'],
		]
	];
})->name('autor');

Route::group(['prefix'	=>	'documentos', 'middleware'	=>	'auth'],function(){

	// INCIO
	Route::get('inicio', 'HomeController@index')->name('dashboard');
	// INCIO

	// AREAS
	Route::resource('areas','AreaController');
	Route::get('areas/editar/{id}','AreaController@editar')->name('areas.editar');
	Route::post('areas/eliminar/{id}','AreaController@destroy')->name('areas.eliminar');
	Route::post('areas/actualizar/{id}','AreaController@update')->name('areas.actualizar');
	// AREAS

	// LUGARES
	Route::resource('lugares','SiteController');
	Route::get('lugares/editar/{id}','SiteController@editar')->name('lugares.editar');
	Route::post('lugares/eliminar/{id}','SiteController@destroy')->name('lugares.eliminar');
	Route::post('lugares/actualizar/{id}','SiteController@update')->name('lugares.actualizar');
	// LUGARES

	// ENTRADAS
	Route::resource('entradas','EntranceController');
	Route::get('entradas/ver/{id}','EntranceController@ver')->name('entradas.ver');
	Route::get('entradas/editar/{id}','EntranceController@editar')->name('entradas.editar');
	Route::post('entradas/actualizar/{id}','EntranceController@update')->name('entradas.actualizar');
	Route::post('entradas/eliminar/{id}','EntranceController@destroy')->name('entradas.eliminar');
    Route::get('entradas/cantidad','EntranceController@cantidad')->name('entradas.cantidad');
	// ENTRADAS

	// SALIDAS
	Route::resource('salidas','DeliveryController');
	Route::get('salidas/ver/{id}','DeliveryController@ver')->name('salidas.ver');
    Route::get('salidas/editar/{id}','DeliveryController@editar')->name('salidas.editar');
	Route::post('salidas/actualizar/{id}','DeliveryController@update')->name('salidas.actualizar');
	Route::post('salidas/eliminar/{id}','DeliveryController@destroy')->name('salidas.eliminar');
    Route::get('salidas/cantidad','DeliveryController@cantidad')->name('salidas.cantidad');
	// SALIDAS

    // Buscar documento
    Route::get('entradas/buscar/{code}','DocumentController@documentCode');
    Route::get('salidas/buscar/{code}','DocumentController@documentCode');
    // Buscar documento

    // GRAFICAS
	Route::get('/charts','ChartsController@charts')->name('charts');
	Route::get('/charts/entradas','ChartsController@charts_entradas')->name('charts_entradas');
	Route::get('/charts/salidas','ChartsController@charts_salidas')->name('charts_salidas');
	Route::get('/charts/entradas/salidas','ChartsController@charts_entradas_salidas')->name('charts_entradas_salidas');
    // GRAFICAS

	// USUARIOS
	Route::resource('usuarios','UsersController');
	Route::get('usuarios/editar/{id}','UsersController@editar')->name('usuarios.editar');
	Route::post('usuarios/actualizar/{id}','UsersController@update')->name('usuarios.actualizar');
    Route::get('cantidad/usuarios','UsersController@cantidad')->name('user.cantidad');
	Route::post('usuarios/eliminar/{id}','UsersController@destroy')->name('usuarios.eliminar');
	// USUARIOS

	// PERSONAS
	Route::resource('personas','PersonController');
    Route::get('cantidad/personas','PersonController@cantidad')->name('person.cantidad');
	// PERSONAS

	// documentos
	Route::resource('documentos','DocumentController');
    Route::get('todos/documentos','DocumentController@all')->name('documentos.all');
	Route::get('ver/documento/{id}','DocumentController@show')->name('documentos.ver');
	Route::get('editar/documento/{id}','DocumentController@editar')->name('documentos.editar');
	Route::post('actualizar/documento/{id}','DocumentController@update')->name('documentos.actualizar');
	Route::delete('eliminar/documento/{id}','DocumentController@destroy')->name('documentos.eliminar');
    Route::get('cantidad/documentos','DocumentController@cantidad')->name('documentos.cantidad');
	// documentos

	// Archivos
	Route::resource('archivos','FileController');
    Route::get('todos/archivos','FileController@all')->name('archivos.all');
	Route::get('ver/archivo/{id}','FileController@show')->name('archivos.ver');
	Route::get('editar/archivo/{id}','FileController@editar')->name('archivos.editar');
	Route::post('actualizar/archivo/{id}','FileController@update')->name('archivos.actualizar');
	Route::delete('eliminar/archivo/{id}','FileController@destroy')->name('archivos.eliminar');
    Route::get('cantidad/archivos','FileController@cantidad')->name('archivos.cantidad');
    Route::get('descargar/archivo/{id}','FileController@descargar')->name('archivos.descargar');
	// Archivos
    
	// documentos tipos
	Route::resource('tipos','DocumentTypeController');
    Route::get('tipos/editar/{id}','DocumentTypeController@editar')->name('tipos.editar');
	Route::post('tipos/eliminar/{id}','DocumentTypeController@destroy')->name('tipos.eliminar');
	Route::post('tipos/actualizar/{id}','DocumentTypeController@update')->name('tipos.actualizar');
	// documentos tipos

	// Entradas y salidas por documento
	Route::get('documentos/entradas/{id}','DocumentController@entradas')->name('documentos.entradas');
	Route::get('documentos/salidas/{id}','DocumentController@salidas')->name('documentos.salidas');
	// Entradas y salidas por documento

	// Tablas de entradas y salidas
	Route::get('ultimas/entradas','DocumentController@entradas_ultimas')->name('ultimas.entradas');
	Route::get('ultimas/salidas','DocumentController@salidas_ultimas')->name('salidas.ultimas');
	// Tablas de entradas y salidas

	// bitacora
	Route::get('bitacora','BinnacleController@index')->name('bitacora.index');
	// bitacora

	// Reportes
	Route::get('reportes','ReportesController@index')->name('reportes.index');
	Route::get('bitacora/pdf/{tipo}','ReportesController@bitacora_pdf')->name('bitacora.pdf');
	Route::get('documento/pdf/{id}','ReportesController@documento')->name('pdf');
	Route::get('documentos/pdf/{tipo}','ReportesController@documento_pdf')->name('documento.pdf');
	Route::get('entradas/pdf/{tipo}','ReportesController@entrada_pdf')->name('entrada.pdf');
	Route::get('salidas/pdf/{tipo}','ReportesController@salida_pdf')->name('salida.pdf');
	// Reportes

	//Busqueda
	Route::get('entradas/lugar/{id}','SiteController@lugar');
	Route::get('salidas/lugar/{id}','SiteController@lugar');
	//Busqueda
});
