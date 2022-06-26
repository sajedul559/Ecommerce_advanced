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

        return view('frontend.index',compact('category'));
    }
}
