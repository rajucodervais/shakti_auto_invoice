@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
        <a href="{{url('/home')}}" class="btn btn-success pull-right">Dashboard</a>
    </div>

  <!-- Content Row -->
    <div class="row content-justify-center">
        <div class="col-md-8">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{route('ChangePassword')}}">
                @csrf
                <div class="row">
                    <div class="col-md-4 text-right">
                        <label for="old_password">Old Password</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" name="old_password" class="form-control" value="{{old('old_password')}}">
                    </div>    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 text-right">
                        <label for="new_password">New Password</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" name="new_password" value="{{old('new_password')}}" class="form-control">
                    </div>    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 text-right">
                        <label for="new_confirm_password">Confirm Password</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" value="{{old('new_confirm_password')}}" name="new_confirm_password" class="form-control">
                    </div>    
                </div>
                <br>
                <div class="row text-right">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>    
                </div>

            </form>
        </div>    
     </div>   
</div>
@endsection
