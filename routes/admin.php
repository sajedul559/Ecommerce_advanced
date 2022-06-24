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
    Route::get('/admin/password/change','AdminController@PasswordChange')->name('admin.password.change');
    Route::post('/admin/password/update','AdminController@PasswordUpdate')->name('admin.password.update');

    //Category Routes
    Route::group(['prefix'=>'category','as'=>'category.'],function(){
        Route::get('/','CategoryController@index')->name('index');
        Route::post('/store','CategoryController@store')->name('store');
        Route::get('/delete/{id}','CategoryController@destroy')->name('delete');
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

    //Brand routes
	Route::group(['prefix'=>'brand','as' =>'brand.'], function(){
		Route::get('/','BrandController@index')->name('index');
		Route::post('/store','BrandController@store')->name('store');
		Route::get('/delete/{id}','BrandController@destroy')->name('delete');
		Route::get('/edit/{id}','BrandController@edit');
		Route::post('/update','BrandController@update')->name('update');
	});

    	//setting Routes
	Route::group(['prefix'=>'setting'], function(){
		//seo setting
		Route::group(['prefix'=>'seo'], function(){
			Route::get('/','SettingController@seo')->name('seo.setting');
			Route::post('/update/{id}','SettingController@seoUpdate')->name('seo.setting.update');
	    });

    });
});