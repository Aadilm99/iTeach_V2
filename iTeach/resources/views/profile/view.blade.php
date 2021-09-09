@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/css/tom-select.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <div class="col-6">
        <div class="card border-bottom-primary">
            <div class="card-header"><h1 class="text-gray-800 p-4">Profile Information</h1></div>
            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                 <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                                @error('confirm_password')
                                 <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Profile Picture</label><br>
                                <input type="file" name="profile_picture">
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <button type="submit" class="btn btn-success">Update Information</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section('js')

    @endsection
    @endsection
