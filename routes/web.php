<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/registros',function(){
    return view('registros.usuarios');
});

Route::get('/perfil_Usuario',function(){
    return view('perfil_Usuario.perfil');
});
Route::get('/show_Producto',function(){
   return view('show_Producto.show'); 
});
Route::post('img'.'PCproductosController@img');

Route::resource('usuarios','usuariosController');

Route::resource('log','LogController');

Route::get('/', 'PCproductosController@index');

Route::get('perfil_Usuario','PCproductosController@perfil');

Route::get('producto/{parameters}','PCproductosController@edit');

Route::get('producto/{parameters}/editar','PCproductosController@edit');

Route::get('producto/{parameters}/borrar','PCproductosController@destroy');

Route::get('producto/{parameters}/ofrecer','PCproductosController@ofrecer');

Route::resource('producto','PCproductosController');

Route::resource('imagen','imagenController');

Route::get('editar/{id_usaurio}','usuariosController@edit');

Route::get('buscar','PCproductosController@buscar');

Route::get('cerrar_sesion','LogController@logout');