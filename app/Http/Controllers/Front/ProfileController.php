<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\Models\User;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setting()
    {
        return view('user.setting');
    }

    public function PasswordChange(Request $request)
    {
       $validated = $request->validate([
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
        ]);

        $current_password=Auth::user()->password;  //login user password get


        $oldpass=$request->old_password;  //oldpassword get from input field
        $new_password=$request->password;  // newpassword get for new password
        if (Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
               $user=User::findorfail(Auth::id());    //current user data get
               $user->password=Hash::make($request->password); //current user password hasing
               $user->save();  //finally save the password
               Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
               $notification=array('message' => 'Your Password Changed!', 'alert-type' => 'success');
               return redirect()->to('/')->with($notification);
        }else{
            $notification=array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
   
    public function customerShipping(Request $request)
    {

        $data=array();
        $data['user_id']=Auth::id();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_country']=$request->shipping_country;
        $data['shipping_city']=$request->shipping_city;
        $data['shipping_zipcode']=$request->shipping_zipcode;
        $data['shipping_email']=$request->shipping_email;

        
        DB::table('shippings')->insert($data);
        $notification=array('message' => 'Shipping setup  success !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

}
