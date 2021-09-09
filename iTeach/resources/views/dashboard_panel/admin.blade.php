@extends('layouts.master')

@section('content')
@if(!Auth('parent') || !Auth('teacher') || Auth::user()->hasRole('Admin'))
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>
    {{--  --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a style="text-decoration:none;" href="{{route('classes.index')}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                {{ sprintf('%02d', count($classes)) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Classes</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <a style="text-decoration:none;" href="{{route('teachers.index')}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                {{ sprintf('%02d', count($teachers)) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Teachers</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <a style="text-decoration:none;" href="{{route('students.index')}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                {{ sprintf('%02d', count($students)) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Students</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <a style="text-decoration:none;" href="{{route('parents.index')}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                {{ sprintf('%02d', count($parents)) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Parents</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>


    {{-- <div>
            <h1>{{ sprintf("%02d", count($classes))}}</h1>
            <span>Classes</span>
        </div>
        <div>
            <span class="las la-chalkboard"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1>{{ sprintf("%02d", count($teachers))}}</h1>
            <span>Teachers</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1>{{ sprintf("%02d", count($students))}}</h1>
            <span>Students</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h1>{{ sprintf("%02d", count($parents))}}</h1>
            <span>Parents</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>



</div> --}}
    {{-- @if (count($classes) > 0)
        <table class="table table-bordered" style="width:60%;background-color:#fff;box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        transform:translateY(22%); ">
            <thead style="pointer-events: none">
                <tr>
                    <th class="h5 mb-0 font-weight-bold text-gray-800">Recent Classes</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">View Class</th>
                    <th scope="col">Edit Class</th>
                    <th scope="col">Delete Class</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td scope="row">{{ $class->id }}</td>
                        <td scope="row">{{ $class->title }}</td>

                        <td scope="row"><a href="{{ url("/classes/{$class->id}") }}"
                                class="btn btn-success btn-sm">View</a></td>
                        <td scope="row"><a href="{{ url("/classes/{$class->id}/edit") }}"
                                class="btn btn-primary btn-sm">Edit</a></td>

                        <td scope="row">
                            <form method="POST" action="{{ url('/classes', [$class->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
            </tbody>
    @endforeach
    </table>
    @endif --}}
    @endif

@endsection
