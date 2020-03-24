<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotationController extends Controller
{
   public function index(){
    	return view('admin.quotations.index');
    }

    public function create(){
    	return view('admin.quotations.create');
    }

    public function store(Request $request){
    	return view('admin.quotations.index');
    }

    public function edit($id){
    	return view('admin.quotations.edit');
    }

    public function update(Request $request,$id){
    	return view('admin.quotations.index');
    }

    public function show($id){
    	return view('admin.quotations.show');
    }

    public function destroy($id){
    	return view('admin.quotations.index');
    }
}
