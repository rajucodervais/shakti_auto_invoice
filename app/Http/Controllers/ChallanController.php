<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChallanController extends Controller
{
    public function index(){
    	return view('challans.index');
    }

    public function create(){
    	return view('challans.create');
    }

    public function store(Request $request){
    	return view('challans.index');
    }

    public function edit($id){
    	return view('challans.edit');
    }

    public function update(Request $request,$id){
    	return view('challans.index');
    }

    public function show($id){
    	return view('challans.show');
    }

    public function destroy($id){
    	return view('challans.index');
    }

}
