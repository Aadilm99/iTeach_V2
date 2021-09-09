@extends('layouts.master')

@section('content')
<div id="container">
    <div class="">
        <h2 class="text-gray-700 font-bold">Create Parent</h2>
    </div>
    <br>
    <br>
    <form method="POST" action="{{ url('/parents') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput"
                placeholder="name" value="{{ old('name') }}">

            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput2">Email</label>
            <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="email" name="email" value="{{ old('email') }}">

            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput2">Password</label>
            <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="password"
                name="password">

            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput2">Phone</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="phone" name="phone"
                value="{{ old('phone') }}">

            @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-center">
                <label class="block text-gray-700 font-bold md:text-center mb-1 md:mb-0 pr-4 text-lg">
                    Gender
                </label>
            </div>
            <div class="d-flex justify-content-center">
                <br>
                <div class="form-check form-check-inline">
                    <label class="block text-gray-700">
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="male">
                        <span class="text-m">Male</span>
                    </label>
                    <label class="ml-4 block text-gray-700">
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="female">
                        <span class="text-m">Female</span>
                    </label>
                    <label class="ml-4 block text-gray-700 ">
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="other">
                        <span class="text-m">Other</span>
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
            <input type="date" class="form-control" name="dateOfbirth" id="formGroupExampleInput" placeholder=""
                value="{{ old('dateOfbirth') }}">

            @error('dateOfbirth')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Current Address</label>
            <input type="text" class="form-control" name="current_address" id="formGroupExampleInput" placeholder=""
                value="{{ old('current_address') }}">

            @error('current_address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Permanent Address</label>
            <input type="text" class="form-control" name="permanent_address" id="formGroupExampleInput" placeholder=""
                value="{{ old('permanent_address') }}">

            @error('permanent_address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                Picture :
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input name="profile_picture" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="file">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                            for="formGroupExampleInput">Parent UID</label>
                        <input type="number" class="form-control" name="is_parent" id="formGroupExampleInput" placeholder="Parent Unique Identifier"
                            value="{{ old('is_parent') }}">

                        @error('is_parent')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div> --}}
        <button type="submit" class=" font-bold btn btn-primary">Create Parent</button>
</div>
</form>
</div>


@endsection
