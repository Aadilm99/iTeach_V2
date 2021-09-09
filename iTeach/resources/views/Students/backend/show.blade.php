@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-4 border-right">
        <div class="card border-bottom-primary shadow h-100 py-40">
            <h1 class="mb-1 text-gray-800 p-4" style="transform: translateY(-16vh)">Student Information</h1>

            <div class="card-body">
                @if($students->user->profile_pic)
                <img class="mb-4" style="transform:translateY(-150px)" src="{{ asset('/profile-pic/'.$students->user->profile_pic) }}">
                 @else
                 <img class="mb-4"
                 style="transform:translate(75px, -150px)"
                 src="{{ asset('/profile-pic/student.png') }}"
                    alt="">
                @endif
                <div style="transform: translateY(-15vh)">
                <label> Student Name:
                    {{$students->user->name}}
                </label>
                <br>

                <label> Student Email:
                    {{$students->user->email}}
                </label>
                <br>


                <label> Phone:
                    {{$students->phone}}
                </label>
                <br>


                <label> Gender:
                    {{$students->gender}}
                </label>
                <br>


                <label> Date of Birth:
                    {{\Carbon\Carbon::parse($students->dateOfbirth)->format('d/m/y')}}
                </label>
                <br>


                <label> Current Address:
                    {{$students->current_address}}
                </label>
                <br>


                <label> Permanent Address:
                    {{$students->permanent_address}}

                </label>
                <br>

                {{-- <label> Class:
                    @foreach ($classes as $class)
                    {{$class->title}}
                    @endforeach

                </label> --}}


                <label> Parent:
                    @foreach ($parents as $parent)
                    {{$parent->user->name}}
                    @endforeach

                </label>
                <br>

                @if(!Auth::user()->hasRole('Teacher') && !Auth::user()->hasRole('Parent'))
                <div class="row">
                <a href="{{url("/students/{$students->id}/edit")}}"
                    class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-3 rounded"
                    style="text-decoration: none" type="submit">Edit Student</a>

                    <form action="{{route('students.destroy',$students->id)}}" method="POST"
                        onsubmit="return confirm('Do you want to delete ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" style="display: inline; margin-left:3px" type="submit">Delete Student</button>
                    </form>
                </div>

                @endif
            </div>
            </div>
        </div>
    </div>

    <div class="col-8">
        <h1 class="mb-0 text-gray-800 p-4">Reflections</h1>
        @if(isset($students->reflections))
        @foreach ($students->reflections as $reflection)
        @if($reflection->users_id == Auth::user()->id && Auth::user()->hasRole('Teacher'))
        <div
            class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3 mb-3">

            <div class="text-base" style="display: inline">
                <h5 class="text-gray-900 leading-none font-bold" style="display: inline">
                    Title :
                </h5>
                <span style="display: inline">{{ "|" }}</span>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">
                    {{ $reflection->title }}
                </h5>
                <span style="display: inline">{{ "|" }}</span>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">Year Group :</h5>
                    <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">
                        {{ $reflection->class->years[0]['years'] }}
                    </h5>

                <p class="text-gray-600 leading-none">
                    {{ucwords($reflection->description)}}
                </p>
                <a class="btn btn-dark btn-sm" href="{{url("/reflection/view/{$reflection->id}")}}">View</a>

                <h6 class="text-gray-900 leading-none font-semibold " style="position: relative;left:480px;top:30px">
                    Created by
                    :
                    <h6 class="text-gray-900 leading-none font-bold " style="position: relative;left:570px;top:6px">
                        {{ $reflection->user->name }}</h6>
                </h6>

            </div>

        </div>
        @elseif(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Parent'))
        <div
            class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3 mb-3">

            <div class="text-base" style="display: inline">
                <h5 class="text-gray-900 leading-none font-bold" style="display: inline">
                    Title :
                </h5>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">
                    {{ $reflection->title }}
                </h5>
                <span style="display: inline">{{ "|" }}</span>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">
                    {{ $reflection->class->title }}
                </h5>
                <span style="display: inline">{{ "|" }}</span>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">Year Group :</h5>
                <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">
                    {{ $reflection->class->years[0]['years'] }}
                </h5>

                <p class="text-gray-600 leading-none">
                    {{ucwords($reflection->description)}}
                </p>
                <a class="btn btn-dark btn-sm" href="{{url("/reflection/view/{$reflection->id}")}}">View</a>

                <h6 class="text-gray-900 leading-none font-semibold " style="position: relative;left:480px;top:30px">
                    Created by
                    :
                    <h6 class="text-gray-900 leading-none font-bold " style="position: relative;left:570px;top:6px">
                        {{ $reflection->user->name }}</h6>
                </h6>

            </div>

        </div>
        @endif
        @endforeach
        @endif
    </div>
</div>


@endsection
