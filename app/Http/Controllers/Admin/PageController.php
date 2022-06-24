<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PageController extends Controller
{
    

     //all page show method
     public function index()
     {
         $page=DB::table('pages')->latest()->get();
         return view('admin.setting.page.index',compact('page'));
     }
      //page create form
    public function create()
    {
        return view('admin.setting.page.create');
    }

      //page store
    public function store(Request $request)
    {
        $data=array();
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name, '-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;
        DB::table('pages')->insert($data);
       $notification = array('message'=>'Page create success','alert-type'=>'success');
       return redirect()->back()->with($notification);
    }

   //page delete
   public function destroy($id)
   {
       DB::table('pages')->where('id',$id)->delete();
       $notification = array('message'=>'Page deleted!','alert-type'=>'success');
       return redirect()->back()->with($notification);
      
   }

   //page edit
   public function edit($id)
   {
       $page=DB::table('pages')->where('id',$id)->first();
       return view('admin.setting.page.edit',compact('page'));
   }


   //page update
   public function update(Request $request,$id)
   {
       $data=array();
       $data['page_position']=$request->page_position;
       $data['page_name']=$request->page_name;
       $data['page_slug']=Str::slug($request->page_name, '-');
       $data['page_title']=$request->page_title;
       $data['page_description']=$request->page_description;
       DB::table('pages')->where('id',$id)->update($data);
       $notification = array('message'=>'Page updated!');
       return redirect()->back()->with($notification);
   }

}
