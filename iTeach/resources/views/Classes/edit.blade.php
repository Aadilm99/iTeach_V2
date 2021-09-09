@extends('layouts.master')

@section('content')
<div id="container">
    <div class="">
        <h2 class="text-gray-700 font-bold">Edit Class</h2>
    </div>
    <br>
    <br>
    <form method="POST" action="{{ url('/classes', [$classes->id]) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
            for="formGroupExampleInput">Class Title</label>
        <input type="text" class="form-control" name="title" id="formGroupExampleInput"
            placeholder="Enter title" value="{{ $classes->title }}">

        @error('title')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
            for="formGroupExampleInput"> Class Description</label>
        <textarea type="text" class="form-control" name="description" id="formGroupExampleInput"
            placeholder="Brief class description" >{{ $classes->description }}</textarea>

        @error('description')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>


    <div class="dropdown">
        <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
            for="formGroupExampleInput">Year Group</label>
      <select type="years_id" class="form-control @error('years_id') is-invalid @enderror" name="years_id" required autocomplete="years_id">
          @if(count($years) > 0)
          @foreach($years as $year)
              <option class="" value="{{ $year->id }}">{{$year->years}}</option>
          @endforeach
          @endif
      </select>

      @error('years_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
<br>
  <div class="dropdown">
    <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
            for="formGroupExampleInput">Assign Teacher</label>
  <select type="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" required autocomplete="teacher_id">
      @if(count($teachers) > 0)
      @foreach($teachers as $teacher)
          <option class="" value="{{ $teacher->id }}">{{$teacher->user->name}}</option>
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
    <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput">Class
        Picture</label>
    <input style="transform:translate(-253px, 10px)" type="file" name="profile_picture" id="formGroupExampleInput">

    @error('profile_picture')
    <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
  <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
