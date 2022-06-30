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

	//warehouse routes
	Route::group(['prefix'=>'warehouse'], function(){
		Route::get('/','WarehouseController@index')->name('warehouse.index');
		Route::post('/store','WarehouseController@store')->name('warehouse.store');
		Route::get('/delete/{id}','WarehouseController@destroy')->name('warehouse.delete');
		Route::get('/edit/{id}','WarehouseController@edit');
		Route::post('/update','WarehouseController@update')->name('warehouse.update');
	});
    //Brand routes
	Route::group(['prefix'=>'brand','as' =>'brand.'], function(){
		Route::get('/','BrandController@index')->name('index');
		Route::post('/store','BrandController@store')->name('store');
		Route::get('/delete/{id}','BrandController@destroy')->name('delete');
		Route::get('/edit/{id}','BrandController@edit');
		Route::post('/update','BrandController@update')->name('update');
	});

	//product routes
	Route::group(['prefix'=>'product'], function(){
		Route::get('/','ProductController@index')->name('product.index');
		Route::get('/create','ProductController@create')->name('product.create');
		Route::post('/store','ProductController@store')->name('product.store');
		Route::get('/delete/{id}','ProductController@destroy')->name('product.delete');
		Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
		Route::post('/update','ProductController@update')->name('product.update');
		Route::get('/active-featured/{id}','ProductController@activefeatured');
		Route::get('/not-featured/{id}','ProductController@notfeatured');
		Route::get('/active-deal/{id}','ProductController@activedeal');
		Route::get('/not-deal/{id}','ProductController@notdeal');
		Route::get('/active-status/{id}','ProductController@activestatus');
		Route::get('/not-status/{id}','ProductController@notstatus');
	});
	//Coupon Routes
	Route::group(['prefix'=>'coupon'], function(){
		Route::get('/','CouponController@index')->name('coupon.index');
		Route::post('/store','CouponController@store')->name('store.coupon');
		Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete');
		Route::get('/edit/{id}','CouponController@edit');
		Route::post('/update','CouponController@update')->name('update.coupon');
	});

	   //Pickup Point
    Route::group(['prefix'=>'pickup-point'], function(){
		Route::get('/','PickupController@index')->name('pickuppoint.index');
		Route::post('/store','PickupController@store')->name('store.pickup.point');
		Route::delete('/delete/{id}','PickupController@destroy')->name('pickup.point.delete');
		Route::get('/edit/{id}','PickupController@edit');
		Route::post('/update','PickupController@update')->name('update.pickup.point');
	});
	//Campaign Routes
	Route::group(['prefix'=>'campaign'], function(){
		Route::get('/','CampaignController@index')->name('campaign.index');
		Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::get('/delete/{id}','CampaignController@destroy')->name('campaign.delete');
		Route::get('/edit/{id}','CampaignController@edit');
		Route::post('/update','CampaignController@update')->name('campaign.update');
	});
	//__campaign product routes__//
	Route::group(['prefix'=>'campaign-product'], function(){
		Route::get('/{campaign_id}','CampaignController@campaignProduct')->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}','CampaignController@ProductAddToCampaign')->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}','CampaignController@ProductListCampaign')->name('campaign.product.list');
		Route::get('/remove/{id}','CampaignController@RemoveProduct')->name('product.remove.campaign');
		// Route::post('/update','CampaignController@update')->name('campaign.update');
	});
	 //Ticket 
	 Route::group(['prefix'=>'ticket'], function(){
		Route::get('/','TicketController@index')->name('ticket.index');
		Route::get('/ticket/show/{id}','TicketController@show')->name('admin.ticket.show');
		Route::post('/ticket/reply','TicketController@ReplyTicket')->name('admin.store.reply');
		Route::get('/ticket/close/{id}','TicketController@CloseTicket')->name('admin.close.ticket');
		Route::delete('/ticket/delete/{id}','TicketController@destroy')->name('admin.ticket.delete');
		
	});




    	//setting Routes
	Route::group(['prefix'=>'setting'], function(){
		//seo setting
		Route::group(['prefix'=>'seo'], function(){
			Route::get('/','SettingController@seo')->name('seo.setting');
			Route::post('/update/{id}','SettingController@seoUpdate')->name('seo.setting.update');
	    });
		//smtp setting
        Route::group(['prefix'=>'smtp'], function(){
			Route::get('/','SettingController@smtp')->name('smtp.setting');
			Route::post('/update/','SettingController@smtpUpdate')->name('smtp.setting.update');
	    });
		 //website setting
		 Route::group(['prefix'=>'website'], function(){
			Route::get('/','SettingController@website')->name('website.setting');
			Route::post('/update/{id}','SettingController@WebsiteUpdate')->name('website.setting.update');
	    });
        
	    //Page setting
		Route::group(['prefix'=>'page'], function(){
			Route::get('/','PageController@index')->name('page.index');
			Route::get('/create','PageController@create')->name('create.page');
			Route::post('/store','PageController@store')->name('page.store');
			Route::get('/delete/{id}','PageController@destroy')->name('page.delete');
			Route::get('/edit/{id}','PageController@edit')->name('page.edit');
			Route::post('/update/{id}','PageController@update')->name('page.update');
	    });


    });
});