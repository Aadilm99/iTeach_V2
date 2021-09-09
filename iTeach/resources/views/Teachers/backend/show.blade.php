@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card border-bottom-primary shadow h-51 py-40">
            <h1 class="mb-1 text-gray-800 p-4" style="transform: translateY(-16vh)">Teacher Information</h1>

            <div class="card-body">
                @if($teachers->user->profile_pic)
                <img class="mb-2" style="transform:translateY(-150px)" src="{{ asset('/profile-pic/'.$teachers->user->profile_pic) }}">
                 @else
                 <img class="mb-0"
                 style="transform:translate(75px, -150px)"
                 src="{{ asset('/profile-pic/users.png') }}"
                    alt="">
                @endif

                <div style="transform: translateY(-15vh)">
                <label> Teacher Name:
                    {{$teachers->user->name}}
                </label>
                <br>

                <label> Teacher Email:
                    {{$teachers->user->email}}
                </label>
                <br>


                <label> Phone:
                    {{$teachers->phone}}
                </label>
                <br>

                <label> Gender:
                    {{$teachers->gender}}
                </label>
                <br>

                <label> Date of Birth:
                    {{\Carbon\Carbon::parse($teachers->dateOfbirth)->format('d/m/y')}}
                </label>
                <br>


                <label> Current Address:
                    {{$teachers->current_address}}
                </label>
                <br>


                <label> Permanent Address:
                    {{$teachers->permanent_address}}

                </label>
                <br>

                <div class="row">
                    <a href="{{url("/teachers/{$teachers->id}/edit")}}"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-3 rounded"
                        style="text-decoration: none" type="submit">Edit Teacher</a>
                    <form action="{{route('teachers.destroy',$teachers->id)}}" method="POST"
                        onsubmit="return confirm('Do you want to delete ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" style="display: inline; margin-left:3px" type="submit">Delete Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

