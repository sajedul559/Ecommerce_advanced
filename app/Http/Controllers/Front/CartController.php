<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Auth;
use DB;



class CartController extends Controller
{
   
    //wishlist
    public function AddWishlist($id)
    {

        if(Auth::check()){
            $check=DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
               if ($check) {
                     $notification=array('message' => 'Already have it on your wishlist !', 'alert-type' => 'error');
                     return redirect()->back()->with($notification); 
               }else{
                    $data=array();
                    $data['product_id']=$id;
                    $data['user_id']=Auth::id();
                    DB::table('wishlists')->insert($data);
                    $notification=array('message' => 'Product added on wishlist!', 'alert-type' => 'success');
                    return redirect()->back()->with($notification); 
               }
        }      
        $notification=array('message' =>'Login Your Account!', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }


     //add to cart method
     public function AddToCartQV(Request $request)
     {
         //3 way to retrive data from database
 
         // $product=DB::table('products')->where('id',$request->id)->first();
         // $product=Product::where('id',$request->id)->first();  
 
         $product=Product::find($request->id);
         Cart::add([
             'id'=>$product->id,
             'name'=>$product->name,
             'qty'=>$request->qty,
             'price'=>$request->price,
             'weight'=>'1',
             'options'=>['size'=>$request->size , 'color'=> $request->color ,'thumbnail'=>$product->thumbnail]
 
         ]);
         return response()->json("product added on cart!");
     }
      //all cart
    public function AllCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }
}
