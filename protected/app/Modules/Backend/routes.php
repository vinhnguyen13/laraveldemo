<?php

Route::group(['prefix' => 'admin', 'module' => 'Backend', 'namespace' => 'App\Modules\Backend\Controllers'], function(){

    Route::get('/test',function(){
        return view("home.index");
    });
    
    Route::get('/', ['uses' => 'DashboardController@getIndex']);
    
    Route::get('/login', ['uses' => 'AuthController@getLogin']);
    
    Route::get('/logout', ['uses' => 'AuthController@getLogout']);
    
    Route::post('/login', ['uses' => 'AuthController@postLogin']);
    
    
    /*-----------------------------CONTACT CONTROLLER---------------------------------------*/
    Route::group(['prefix' => 'contact'], function(){
        
        Route::get('/', ['uses' => 'ContactController@getContactList']);
        
        Route::get('/create', ['uses' => 'ContactController@getContact']);
        Route::post('/create', ['uses' => 'ContactController@postContact']);
        
        Route::get('/edit/{id}', ['uses' => 'ContactController@getContact']);
        Route::put('/edit/{id}', ['uses' => 'ContactController@putContact']);
        
        Route::post('/ordering', ['uses' => 'ContactController@postOrdering']);
        
        Route::get('/delete/{id}', ['uses' => 'ContactController@getDelete']);
        
        Route::get('/published/{id}', ['uses' => 'ContactController@getPublished']);
    });
    
    
    /*-----------------------------NEWS CONTROLLER---------------------------------------*/
    Route::group(['prefix' => 'content'], function(){
        
        Route::get('/', ['uses' => 'NewsController@getNewsList']);
        
        Route::get('/create', ['uses' => 'NewsController@getContent']);
        Route::post('/create', ['uses' => 'NewsController@postContent']);
        
        Route::get('/edit/{id}', ['uses' => 'NewsController@getContent']);
        Route::put('/edit/{id}', ['uses' => 'NewsController@putContent']);
        
        Route::post('/ordering', ['uses' => 'NewsController@postOrdering']);
        
        Route::get('/delete/{id}', ['uses' => 'NewsController@getDelete']);
        
        Route::get('/published/{id}', ['uses' => 'NewsController@getPublished']);
    });
    
    
    /*-----------------------------MENU CONTROLLER---------------------------------------*/
    Route::group(['prefix' => 'menu'], function(){
        
        Route::get('/category', ['uses' => 'MenuController@getMenuCatList']);
        
        Route::get('/{id?}', ['uses' => 'MenuController@getMenuList']);
        
        Route::get('/create/{cid}', ['uses' => 'MenuController@getMenu']);
        Route::post('/create/{cid}', ['uses' => 'MenuController@postMenu']);
        
        Route::get('/edit/{cid}/{id}', ['uses' => 'MenuController@getMenu']);
        Route::put('/edit/{cid}/{id}', ['uses' => 'MenuController@putMenu']);
        
        Route::post('/ordering', ['uses' => 'MenuController@postOrdering']);
        
        Route::get('/delete/{cid}/{id}', ['uses' => 'MenuController@getDelete']);
        
        Route::get('/published/{cid}/{id}', ['uses' => 'MenuController@getPublished']);
    });
});