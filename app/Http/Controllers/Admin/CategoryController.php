<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all category showing method
    public function index()
    {
        $data = DB::table('categories')->get();
        return view('admin.category.category.index',compact('data'));
    }
    public function store(Request $request)
    { 
      $validated= $request->validate([
        'category_name' => 'required|unique:categories|max:55' 
      ]);

      //Query Builder
    //   $data = array();
    //   $data['category_name'] = $request->category_name;
    //   $data['category_slug'] = Str::slug($request->category_name,'-');

    //   DB::table('categories')->insert($data);

      Category::insert([
        'category_name' => $request->category_name,
        'category_slug' => Str::slug($request->category_name, '-')
      ]);
      $notification = array('message' => 'Category Inserted!','alert-type' => 'success');

      return redirect()->back()->with($notification);
    }
   //Delete Category
   public function delete($id)
   {
     $data = Category::findorfail($id)->delete();

     $notification = array('message' => 'Category Deleted!','alert-type' => 'success');
     return redirect()->back()->with($notification);
   }

   public function edit($id)
   {
     $data = Category::findorfail($id);
     return response()->json($data);
   }

   public function update(Request $request)
   {
    $id = $request->id;
    $data = Category::findorfail($id);
    $data->category_name = $request->category_name;
    $data->category_slug = Str::slug($request->category_name, '-');
    $data->save();
    $notification = array('message' => 'Category Updated!','alert-type' => 'success');
    return redirect()->back()->with($notification);


   }

  //get child category
  public function GetChildCategory($id)  //subcategory_id
  {
      $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
      return response()->json($data);
  }

 
}
