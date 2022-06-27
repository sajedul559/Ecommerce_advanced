<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

}
