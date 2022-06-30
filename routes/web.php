<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Auth::routes();
Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::get('/ffff', function () {
    return view('frontend.product_details');
});

Route::group(['namespace'=>'App\Http\Controllers\Front'],function(){

    //Frontend all route here
    Route::get('/','IndexController@index');
    Route::get('/product-details/{slug}','IndexController@ProductDetails')->name('product.details');
    Route::get('/product-quick-view/{id}','IndexController@ProductQuickView');


    //review for product
    Route::post('/store/review','ReviewController@store')->name('store.review');

    //categorywise product
    Route::get('/category/product/{id}','IndexController@categoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategory/product/{id}','IndexController@SubcategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}','IndexController@ChildcategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brandwise/product/{id}','IndexController@BrandWiseProduct')->name('brandwise.product');

     //cart
     Route::get('/all-cart','CartController@AllCart')->name('all.cart'); //ajax request for subtotal
     Route::get('/my-cart','CartController@MyCart')->name('cart');
     Route::get('/cart/empty','CartController@EmptyCart')->name('cart.empty');
     Route::get('/checkout','CheckoutController@Checkout')->name('checkout');
     Route::post('/apply/coupon','CheckoutController@ApplyCoupon')->name('apply.coupon');
     Route::get('/remove/coupon','CheckoutController@RemoveCoupon')->name('coupon.remove');
     Route::post('/order/place','CheckoutController@OrderPlace')->name('order.place');

     Route::post('/addtocart','CartController@AddToCartQV')->name('add.to.cart.quickview');
     Route::get('/cartproduct/remove/{rowId}','CartController@RemoveProduct');
     Route::get('/cartproduct/updateqty/{rowId}/{qty}','CartController@UpdateQty');
     Route::get('/cartproduct/updatecolor/{rowId}/{color}','CartController@UpdateColor');
     Route::get('/cartproduct/updatesize/{rowId}/{size}','CartController@UpdateSize');

    //wishlist
    Route::get('/wishlist','CartController@wishlist')->name('wishlist');
    Route::get('/clear/wishlist','CartController@Clearwishlist')->name('clear.wishlist');
    Route::get('/add/wishlist/{id}','CartController@AddWishlist')->name('add.wishlist');
    Route::get('/wishlist/product/delete/{id}','CartController@WishlistProductdelete')->name('wishlistproduct.delete');
    //categorywise product
    Route::get('/category/product/{id}','IndexController@categoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategory/product/{id}','IndexController@SubcategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}','IndexController@ChildcategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brandwise/product/{id}','IndexController@BrandWiseProduct')->name('brandwise.product');

     //setting profile
     Route::get('/home/setting','ProfileController@setting')->name('customer.setting'); 
     Route::post('/home/shipping','ProfileController@customerShipping')->name('customer.shipping'); 

     Route::post('/home/password/update','ProfileController@PasswordChange')->name('customer.password.change'); 
 
     Route::get('/my/order','ProfileController@MyOrder')->name('my.order'); 
     Route::get('/view/order/{id}','ProfileController@ViewOrder')->name('view.order'); 
    //newsletter
    Route::post('/store/newsletter','IndexController@storeNewsletter')->name('store.newsletter');



     //review for product
     Route::post('/store/review','ReviewController@store')->name('store.review');
     //this review for website not product
     Route::get('/write/review','ReviewController@write')->name('write.review');
     Route::post('/store/website/review','ReviewController@StoreWebsiteReview')->name('store.website.review');
      //support ticket
    Route::get('/open/ticket','ProfileController@ticket')->name('open.ticket');
    Route::get('/new/ticket','ProfileController@NewTicket')->name('new.ticket');
    Route::post('/store/ticket','ProfileController@StoreTicket')->name('store.ticket');
    Route::get('/show/ticket/{id}','ProfileController@ticketShow')->name('show.ticket');
    Route::post('/reply/ticket','ProfileController@ReplyTicket')->name('reply.ticket'); 

});
