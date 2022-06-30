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
        $brand=DB::table('brands')->where('front_page',1)->limit(24)->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $todaydeal=Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $popular_product=Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product=Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $review=DB::table('wbreviews')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
        //homepage category
       $home_category=DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();


       // $campaign=DB::table('campaigns')->where('status',1)->orderBy('id','DESC')->first();

        return view('frontend.index',compact('category','bannerproduct','featured','popular_product','trendy_product','brand','random_product','todaydeal','home_category','review'));
    }

    
    //singleproduct page calling method
    public function ProductDetails($slug)
    {
        $product=Product::where('slug',$slug)->first();
                 Product::where('slug',$slug)->increment('product_views');
         $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
         $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();

        

        return view('frontend.product_details',compact('product','related_product','review'));
    }

      //product quick view
      public function ProductQuickView($id)
      {
          $product=Product::where('id',$id)->first();
          return view('frontend.product.quick_view',compact('product'));
      }

       //categorywise product page
    public function categoryWiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('category_id',$id)->paginate(60);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.category_products',compact('subcategory','brand','products','random_product','category'));

    }

     //subcategorywise product
     public function SubcategoryWiseProduct($id)
     {
         $subcategory=DB::table('subcategories')->where('id',$id)->first();
         $childcategories=DB::table('childcategories')->where('subcategory_id',$id)->get();
         $brand=DB::table('brands')->get();
         $products=DB::table('products')->where('subcategory_id',$id)->paginate(60);
         $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
         return view('frontend.product.subcategory_product',compact('childcategories','brand','products','random_product','subcategory'));
     }
 
     //childcategory product
     public function ChildcategoryWiseProduct($id)
     {
         $childcategory=DB::table('childcategories')->where('id',$id)->first();
         $categories=DB::table('categories')->get();
         $brand=DB::table('brands')->get();
         $products=DB::table('products')->where('childcategory_id',$id)->paginate(60);
         $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
         return view('frontend.product.childcategory_product',compact('categories','brand','products','random_product','childcategory'));
     }
 
     //brandwise product
     public function BrandWiseProduct($id)
     {
         $brand=DB::table('brands')->where('id',$id)->first();
         $categories=DB::table('categories')->get();
         $brands=DB::table('brands')->get();
         $products=DB::table('products')->where('brand_id',$id)->paginate(60);
         $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
         return view('frontend.product.brandwise_product',compact('categories','brands','products','random_product','brand'));
     }
      //store newsletter
    public function storeNewsletter(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
            return response()->json('Email Already Exist!');
        }else{
              $data=array();
              $data['email']=$request->email;
              DB::table('newsletters')->insert($data);
              return response()->json('Thanks for subscribe us!');  
        }
       

    }

 
  
}
