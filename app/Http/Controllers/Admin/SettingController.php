<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     //seo page show method
     public function seo()
     {
         $data=DB::table('seos')->first();
         return view('admin.setting.seo',compact('data'));
     }

     public function smtp()
     {
         // $smtp=DB::table('smtp')->first();
         return view('admin.setting.smtp');
     }
    //smtp update
    public function smtpUpdate(Request $request){
        // $data=array();
        // $data['mailer']=$request->mailer;
        // $data['host']=$request->host;
        // $data['port']=$request->port;
        // $data['user_name']=$request->user_name;
        // $data['password']=$request->password;
        // DB::table('smtp')->where('id',$id)->update($data);
        // $notification=array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);

        foreach($request->types as $key=>$type){
            $this->updateEnvFile($type, $request[$type]);
        }
       $notification = array('message'=>'SMTP updated!','alert-type'=>'success');
       return redirect()->back()->with($notification);
    }

    public function updateEnvFile($type, $val)
    {
        $path=base_path('.env');
        if (file_exists($path)) {
            $val='"'.trim($val).'"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, 
                        str_replace($type.'="'.env($type).'"', $type.'='.$val,
                            file_get_contents($path)
                        )
                    );
            }else{
                file_put_contents($path,file_get_contents($path).$type.'='.$val);
            }
        }
    }
}
