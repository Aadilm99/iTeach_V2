@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/css/tom-select.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div id="container" style="height: 108vh;">
        <div class="">
            <h2 class="text-gray-700 font-bold">Create Reflection</h2>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('reflections.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                    for="formGroupExampleInput">Reflection Title</label>
                <input type="text" class="form-control" name="title" id="formGroupExampleInput"
                    placeholder="Enter title here..." value="{{ old('title') }}" required>

                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput2">Add
                    Students</label>
                <select class="form-control" style="pointer-events: pointer" name="studentName[]" id="studentName" multiple required>
                    @if (count($students) > 0)
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ ucfirst($student->user->name) }}</option>
                        @endforeach
                    @endif
                </select>

                @error('student_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4"
                    for="formGroupExampleInput2">Description</label>
                <textarea type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Enter description here..." name="description"
                    value="{{ old('description') }}"></textarea>

                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput2">Add
                    Resources</label>

                <div class="col-md-6">
                    <input type="file" class="form-control-file" name="resources" value="{{ old('resources') }}" autocomplete="resources"
                        autofocus>

                    @error('resources')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="block text-gray-700 font-bold md:text-left mb-1 md:mb-0 pr-4" for="formGroupExampleInput2">Add Assessments</label>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div>
                            <label for="price" class="block text-left text-sm font-medium text-gray-700">Assessment 1</label>
                            <div class="mt-1 relative rounded-md">
                                <input type="text" class="form-control mt-2" name="assigment[0][name]" id="assigment">
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-left text-sm font-medium text-gray-700">Assessment 2</label>
                            <div class="mt-1 relative rounded-md">
                                <input type="text" class="form-control mt-2" name="assigment[1][name]" id="assigment" placeholder="">
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-left text-sm font-medium text-gray-700">Assessment 3</label>
                            <div class="mt-1 relative rounded-md">
                                <input type="text" class="form-control mt-2" name="assigment[2][name]" id="assigment" placeholder="">
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-left text-sm font-medium text-gray-700">Assessment 4</label>
                            <div class="mt-1 relative rounded-md">
                                <input type="text" class="form-control mt-2" name="assigment[3][name]" id="assigment" placeholder="">
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-left text-sm font-medium text-gray-700">Assessment 5</label>
                            <div class="mt-1 relative rounded-md">
                                <input type="text" class="form-control mt-2" name="assigment[4][name]" id="assigment" placeholder="">
                            </div>
                        </div>

                    </div>
                </div>

                @error('assigment')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="class_id" value="{{ $class_id }}">
            <input type="hidden" name="year_id" value="{{ $year->id }}">
            <div class="form-group">
                <button type="submit" class="font-bold btn btn-success">Create Reflection</button>
            </div>
    </div>
    </form>
    </div>


@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/js/tom-select.complete.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#studentName').select2();
</script>
@endsection
