<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class AdminController extends Controller
{
    public function profile(){
    	return view('admin.profile');
    }
    public function change_pass_show(){
    	return view('admin.change_pass');	
    }
    public function change_pass(Request $request){
    	$this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8|max:20',
            'new_confirm_password' => 'required|same:new_password',
        ]);

        $data = $request->all();

        if(!\Hash::check($data['old_password'], auth()->user()->password)){

             return back()->with('error','You have entered wrong password');

        }else{
			 User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
			 return back()->with('success','password changed successfully');
        }
    }
    public function settings(){
    	return view('admin.settings');
    }
}
