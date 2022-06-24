<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //index method for read data
    public function index()
    {
    	    //Query Builder with one to one join
    	// $data=DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
    	//       ->select('subcategories.*','categories.category_name')->get();

    	     //Eloquent ORM
    	$data=Subcategory::all();
    	$category=Category::all();  
    	//$category=DB::table('categories')->get();  
    	 return view('admin.category.subcategory.index',compact('data','category'));     
    }


  
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug'] = Str::slug($request->subcategory_name);
        DB::table('subcategories')->insert($data);

        $notification = array('message'=>'Subcategory insertedd','alert-type' =>'success');
        return redirect()->back()->with($notification);
    }



    //edit subcategory
    public function edit($id)
    {
    	    // Eloquent ORM
    	// $data=Subcategory::find($id);
    	// $category=Category::all();
    	    //Query Builder
    	$data=Subcategory::find($id);
    	$category=DB::table('categories')->get();

    	return view('admin.category.subcategory.edit',compact('data','category'));
    }

    // //update method
    // public function update(Request $request)
    // {
      
    // 	$data=array();
    // 	$data['category_id']=$request->category_id;
    // 	$data['subcategory_name']=$request->subcategory_name;
    // 	$data['subcat_slug']=Str::slug($request->subcategory_name, '-');
    // 	DB::table('subcategories')->where('id',$request->id)->update($data);

    //    $notification=array('messege' => 'Subategory Updated!', 'alert-type' => 'success');
    // 	return redirect()->back()->with($notification);
    // }

   public function update(Request $request)
   {
      $data = array();
       $data['category_id'] = $request->category_id;
       $date['subcategory_name'] = $request->subcategory_name;
       $data['subcat_slug'] = Str::slug($request->subcategory_name);
       DB::table('subcategories')->update($date);
       $notification = array('message' =>'Subcategory update!', 'alert-type'=>'success');
       return redirect()->back()->with($notification);
   }
   public function destroy($id)
   {
     $data = Subcategory::findorfail($id)->delete();

     $notification = array('message' => 'Subcategory Deleted!','alert-type' => 'success');
     return redirect()->back()->with($notification);
   }
    
    
    


}
