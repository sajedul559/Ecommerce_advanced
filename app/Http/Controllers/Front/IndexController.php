<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;
class IndexController extends Controller
{
    public function index()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->latest()->first();
       // dd($bannerproduct);
        return view('frontend.index',compact('category','bannerproduct'));
    }
    
    //singleproduct page calling method
    public function ProductDetails($slug)
    {
        $product=Product::where('slug',$slug)->first();
                //  Product::where('slug',$slug)->increment('product_views');
         $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
         $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();

        

        return view('frontend.product_details',compact('product','related_product','review'));
    }
}
