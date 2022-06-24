<?php

use Illuminate\Support\Facades\Route;


Route::get('check',function(){
    return " this is admin route";

});
Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

//Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware' =>'is_admin'],function(){

    Route::get('/admin/home','AdminController@admin')->name('admin.home');
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');

    //Category Routes
    Route::group(['prefix'=>'category','as'=>'category.'],function(){
        Route::get('/','CategoryController@index')->name('index');
        Route::post('/store','CategoryController@store')->name('store');
        Route::get('/delete/{id}','CategoryController@delete')->name('delete');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update','CategoryController@update')->name('update');

    });

     // Sub Category Routes
     Route::group(['prefix'=>'subcategory','as'=>'subcategory.'],function(){
        Route::get('/','SubcategoryController@index')->name('index');
        Route::post('/store','SubcategoryController@store')->name('store');
        Route::get('/delete/{id}','SubcategoryController@destroy')->name('delete');
        Route::get('/edit/{id}','SubcategoryController@edit');
        Route::post('/update','SubcategoryController@update')->name('update');

    });
    //global route
	Route::get('/get-child-category/{id}','CategoryController@GetChildCategory');

	//subcategory routes
	Route::group(['prefix'=>'childcategory','as' =>'childcategory.'], function(){
		Route::get('/','ChildcategoryController@index')->name('index');
		Route::post('/store','ChildcategoryController@store')->name('store');
		Route::get('/delete/{id}','ChildcategoryController@destroy')->name('delete');
		Route::get('/edit/{id}','ChildcategoryController@edit');
		Route::post('/update','ChildcategoryController@update')->name('update');
	});


});