<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web','admin'], 'as' => 'admin.'],function(){
    Route::group(['prefix' => 'planoconta'], function () {
        Route::get('/','PlanoContaController@index');
        Route::get('list', 'PlanoContaController@list');
        Route::post('create', 'PlanoContaController@create');
        Route::get('createActivation/{planocontaId}', 'PlanoContaController@createActivation');
        Route::get('delete/{id}', 'PlanoContaController@delete');
        Route::post('update/{id}', 'PlanoContaController@update');
        Route::get('view/{id}', 'PlanoContaController@view');
    });
});

