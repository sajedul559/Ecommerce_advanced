<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ChildcategoryController extends Controller
{
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('childcategories')->get();
        return view('admin.category.subcategory.index');
    }
}
