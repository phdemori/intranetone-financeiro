<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web','admin'], 'as' => 'admin.'],function(){
    Route::group(['prefix' => 'financeiro'], function () {
        Route::get('/','FinanceiroController@index');
        Route::get('list', 'FinanceiroController@list');
        Route::post('create', 'FinanceiroController@create');
        Route::get('createActivation/{financeiroId}', 'FinanceiroController@createActivation');
        Route::get('delete/{id}', 'FinanceiroController@delete');
        Route::post('update/{id}', 'FinanceiroController@update');
        Route::get('view/{id}', 'FinanceiroController@view');
    });
});

