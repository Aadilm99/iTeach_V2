
@extends('layouts.master')

@section('content')
<div id="container" style="height: 135vh;">
    <div class="">
        <h2 class="text-gray-700 font-bold">Edit Student</h2>
    </div>
    <br>
    <br>
    <form method="POST" action="{{ url('/students', [$students->id]) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput"
                placeholder="name" value="{{ $students->user->name }}">

            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput2">Email</label>
            <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="email" name="email" value="{{ $students->user->email }}">

            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput2">Phone</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="phone number" name="phone"
                value="{{ $students->phone }}">

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
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="male" {{ ($students->gender == 'male') ? 'checked' : '' }}>
                        <span class="text-sm">Male</span>
                    </label>
                    <label class="ml-4 block text-gray-500 font-bold">
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="female" {{ ($students->gender == 'female') ? 'checked' : '' }}>
                        <span class="text-sm">Female</span>
                    </label>
                    <label class="ml-4 block text-gray-500 font-bold">
                        <input name="gender" class="mr-2 leading-tight" type="radio" value="other" {{ ($students->gender == 'other') ? 'checked' : '' }}>
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
            <input type="date" class="form-control" name="dateOfbirth" id="formGroupExampleInput" placeholder=""
                value="{{ $students->dateOfbirth }}">

            @error('dateOfbirth')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Current Address</label>
            <input type="text" class="form-control" name="current_address" id="formGroupExampleInput" placeholder=""
                value="{{ $students->current_address }}">

            @error('current_address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Permanent Address</label>
            <input type="text" class="form-control" name="permanent_address" id="formGroupExampleInput" placeholder=""
                value="{{ $students->permanent_address }}">

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
                    <div class="form-group">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                            for="formGroupExampleInput">Roll Number</label>
                        <input type="number" class="form-control" name="roll_number" id="formGroupExampleInput" placeholder="Unique Student Identifier"
                            value="{{ $students->roll_number }}">

                        @error('roll_number')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="dropdown">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Assign Class</label>
                      <select type="class_id" class="form-control @error('class_id') is-invalid @enderror" name="class_id" required autocomplete="class_id">
                          @if(count($classes) > 0)
                          @foreach($classes as $class)
                              <option class="" value="{{ $class->id }}">{{$class->title}}</option>
                          @endforeach
                          @endif
                      </select>

                      @error('teacher_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="dropdown">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                for="formGroupExampleInput">Assign Parent</label>
                      <select type="parent_id" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id"  autocomplete="parent_id">
                          @if(count($parents) > 0)
                          <option value="" selected  >Choose here</option>
                          @foreach($parents as $parent)
                              <option class="" value="{{ $parent->id }}">{{$parent->user->name}}</option>
                          @endforeach
                          @endif
                      </select>

                      @error('teacher_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput">
                            Profile Picture</label>
                        <input style="transform:translate(-253px, 10px)" type="file" name="profile_picture" id="formGroupExampleInput">

                        @error('profile_picture')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <br>
        <button type="submit" class=" font-bold btn btn-primary">Save</button>
</div>
</form>
</div>
@endsection




