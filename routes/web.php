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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('DireccionDeInformatica',function(){
	return ['Autor'=>
		[
			['estado'=>'inicio del sistema','fecha'=>'22/05/2019'],
			['nombre'=>'Jhonny Pérez','correo'=>'jhperez@unerg.edu.ve'],
			['estado'=>'sistema finalizado','fecha'=>'31/05/2019'],
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
	// AREAS

	// LUGARES
	Route::resource('lugares','SiteController');
	Route::get('lugares/editar/{id}','SiteController@editar')->name('lugares.editar');
	// LUGARES

	// ENTRADAS
	Route::resource('entradas','EntranceController');
	Route::get('entradas/ver/{id}','EntranceController@ver')->name('entradas.ver');
	Route::post('entradas/editar/{id}','EntranceController@editar')->name('entradas.editar');
    Route::post('entradas/cantidad','EntranceController@cantidad')->name('entradas.cantidad');
	// ENTRADAS

	// SALIDAS
	Route::resource('salidas','DeliveryController');
	Route::get('salidas/ver/{id}','DeliveryController@ver')->name('salidas.ver');
    Route::post('salidas/editar/{id}','DeliveryController@editar')->name('salidas.editar');
    Route::post('salidas/cantidad','DeliveryController@cantidad')->name('salidas.cantidad');
	// SALIDAS

    // GRAFICAS
	Route::get('/charts','ChartsController@charts')->name('charts');
	Route::get('/charts/entradas','ChartsController@charts_entradas')->name('charts_entradas');
	Route::get('/charts/salidas','ChartsController@charts_salidas')->name('charts_salidas');
	Route::get('/charts/entradas/salidas','ChartsController@charts_entradas_salidas')->name('charts_entradas_salidas');
    // GRAFICAS

	// USUARIOS
	Route::resource('usuarios','UsersController');
	Route::post('editar/{id}','UsersController@editar')->name('user.editar');
    Route::post('cantidad','UsersController@cantidad')->name('user.cantidad');
	// USUARIOS

	// PERSONAS
	Route::resource('personas','PersonController');
	Route::post('editar/{id}','PersonController@editar')->name('person.editar');
    Route::post('cantidad','PersonController@cantidad')->name('person.cantidad');
	// PERSONAS

	// documentos
	Route::resource('documentos','DocumentController');

    Route::get('todos/documentos','DocumentController@all')->name('documentos.all');

	Route::get('ver/documento/{id}','DocumentController@show')->name('documentos.ver');

	Route::get('editar/documento/{id}','DocumentController@editar')->name('documentos.editar');

	Route::put('actualizar/documento/{id}','DocumentController@update')->name('documentos.actualizar');
	
	Route::delete('eliminar/documento/{id}','DocumentController@destroy')->name('documentos.eliminar');
    
    Route::post('cantidad','DocumentController@cantidad')->name('documentos.cantidad');
	// documentos
    
	// documentos tipos
    Route::get('tipo/documento','DocumentTypeController@index')->name('tipos.index');
    
    Route::post('nuevo/tipo/documento','DocumentTypeController@store')->name('tipos.crear');
    
    Route::post('eliminar/tipo/documento/{id}','DocumentTypeController@destroy')->name('tipos.eliminar');
    
    Route::post('editar/tipo/documento/{id}','DocumentTypeController@edit')->name('tipos.editar');
    
    Route::post('actualizar/tipo/documento/{id}','DocumentTypeController@update')->name('tipos.actualizar');
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
		// PDF
	Route::get('bitacora/pdf/{tipe}','ReportesController@bitacora_pdf')->name('bitacora.pdf');
		// EXCEL
	Route::get('bitacora/excel/{tipe}','ReportesController@bitacora_excel')->name('bitacora.excel');
	// Reportes
});
