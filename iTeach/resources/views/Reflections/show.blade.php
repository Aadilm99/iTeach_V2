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
</div>
<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3">

    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="card p-4">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="text-center">{{ strtoupper($reflection->title) }}</h4>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 border rounded p-2">
                            @php
                                $ext = pathinfo(storage_path('/public/reflection-documents/').$reflection->resources, PATHINFO_EXTENSION);

                            @endphp

                            @if($ext == 'png' ||  $ext == 'jpg')
                                <a href="{{ asset('/reflection-documents/'.$reflection->resources) }}" target="_blank"><img src="https://image.flaticon.com/icons/png/512/2489/2489605.png" width="50"></a>
                            @elseif($ext == 'pdf')
                                <a href="{{ asset('/reflection-documents/'.$reflection->resources) }}" target="_blank"><img
                                        src="https://image.flaticon.com/icons/png/512/136/136522.png" width="50"></a>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <h5> Students :</h5>
                            @foreach ($reflection->students as $student)
                                <span class="d-inline">{{ $student->user->name }} {{ "," }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h5> Note :</h5>
                            <input type="text" class="form-control w-100 h-100" value="{{ $reflection->description }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h5> Assessments :</h5>
                            <ul>
                                @foreach ($reflection->reflectionDetails as $detail)
                                    <li style="list-style:circle">{{ $detail->assessments->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if(!Auth::user()->hasRole('Parent'))
                    @if(!Auth::user()->hasRole('Admin'))
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <a href="{{ route('reflection.edit',$reflection->id) }}" class="btn btn-warning">Edit</a>
                                @endif
                                <form action="{{ route('reflection.delete', $reflection->id) }}" method="POST" onsubmit="return confirm('Do you want to delete ?')" style="display: inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3">

    </div>
</div>

    @section('js')

    <script src="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        var config = {};
        new TomSelect('#studentName', config);

    </script>
    @endsection
    @endsection
