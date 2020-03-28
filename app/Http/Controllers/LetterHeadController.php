<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LetterHead;
class LetterHeadController extends Controller
{
    public function index(){
    	return view('letter_heads.index');
    }
    public function create(){
    	return view('letter_heads.index');
    }
    public function store(Request $request){
    	return view('letter_heads.index');
    }
    public function edit($id){
    	return view('letter_heads.index');
    }
    public function update(Request $request, $id){
    	return view('letter_heads.index');
    }
    public function show($id){
    	return view('letter_heads.index');
    }
    public function destroy($id){
    	return view('letter_heads.index');
    }
}
