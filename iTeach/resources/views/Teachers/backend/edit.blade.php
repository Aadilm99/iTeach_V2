@extends('layouts.master')

@section('content')
<div id="container">
        <div class="">
            <h2 class="text-gray-700 font-bold">Edit Teacher</h2>
        </div>
        <br>
        <br>
        <form method="POST" action="{{ url('/teachers', [$teachers->id]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput">Name</label>
                <input type="text" class="form-control" @error('name') is-invalid @enderror id="exampleInputEmail1" name="name" value="{{$teachers->user->name}}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                        for="formGroupExampleInput2">Email</label>
                    <input type="email" class="form-control" @error('email') is-invalid @enderror id="formGroupExampleInput2" name="email" value="{{ $teachers->user->email }}" required autocomplete="email" autofocus>

                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput2">Phone</label>
                        <input type="text" class="form-control" @error('phone') is-invalid @enderror id="formGroupExampleInput2" name="phone" value="{{ $teachers->phone }}">

                            @error('phone')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Gender
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <div class="flex flex-row items-center">
                                    <label class="block text-gray-500 font-bold">
                                        <input name="gender" class="mr-2 leading-tight" type="radio" value="male" {{ ($teachers->gender == 'male') ? 'checked' : '' }}>
                                        <span class="text-sm">Male</span>
                                    </label>
                                    <label class="ml-4 block text-gray-500 font-bold">
                                        <input name="gender" class="mr-2 leading-tight" type="radio" value="female" {{ ($teachers->gender == 'female') ? 'checked' : '' }}>
                                        <span class="text-sm">Female</span>
                                    </label>
                                    <label class="ml-4 block text-gray-500 font-bold">
                                        <input name="gender" class="mr-2 leading-tight" type="radio" value="other" {{ ($teachers->gender == 'other') ? 'checked' : '' }}>
                                        <span class="text-sm">Other</span>
                                    </label>
                                </div>
                                @error('gender')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                                    <div class="form-group">
                                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput">Date
                                            of Birth</label>
                                        <input type="date" class="form-control" name="dateOfbirth" @error('gender') is-invalid @enderror id="formGroupExampleInput"
                                                value="{{ $teachers->dateOfbirth }}" required autocomplete="dateOfbirth" autofocus>

                                            @error('dateOfbirth')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                                                for="formGroupExampleInput">Current Address</label>
                                            <input type="text" class="form-control" name="current_address" @error('current_address') is-invalid @enderror
                                                    id="formGroupExampleInput" value="{{ $teachers->current_address }}" required autocomplete="current_address" autofocus>

                                                @error('current_address')
                                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput">Permanent Address</label>
                                                <input type="text" class="form-control" name="permanent_address" @error('permanent_address') is-invalid @enderror id="formGroupExampleInput" value="{{ $teachers->permanent_address }}" autocomplete="permanent_address" autofocus>

                                                    @error('permanent_address')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>


                                                <button type="submit" class=" font-bold btn btn-primary">Save</button>

                                            </form>
                                        </div>

@endsection
