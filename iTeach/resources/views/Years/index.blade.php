@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Year Groups</h3></div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/addYearGroup') }}">
                        @csrf
                        <br>
                        <div class="form-inline">
                            <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                            for="years">Add Year Group</label>
                            <input type="text" class="form-control" name="years" id="formGroupExampleInput" placeholder="In upper case..." value="{{ old('years') }}">


                            <button style="transform:translateX(10%)" type="submit" role="button"class="btn btn-primary">Create</button>

                        </div>
                        <br>
                        @error('years')
                                <p class="text-red-500 text-xs italic" style="font-size: 15px">{{ $message }}</p>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
