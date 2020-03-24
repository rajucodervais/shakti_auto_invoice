<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile(){
    	return view('admin.profile');
    }
    public function change_pass(){
    	return view('admin.change_pass');	
    }
    public function settings(){
    	return view('admin.settings');
    }
}
