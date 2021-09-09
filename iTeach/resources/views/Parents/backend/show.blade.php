@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card border-bottom-primary shadow h-51 py-40">
            <h1 class="mb-1 text-gray-800 p-4" style="transform: translateY(-16vh)">Parent Information</h1>

            <div class="card-body">
                @if($parents->user->profile_pic)
                <img class="mb-0" style="transform:translateY(-150px)" src="{{ asset('/profile-pic/'.$parents->user->profile_pic) }}">
                 @else
                 <img class="mb-0"
                 style="transform:translate(75px, -150px)"
                 src="{{ asset('/profile-pic/users.png') }}"
                    alt="">
                @endif

                <div style="transform: translateY(-15vh)">
                <label> Parent Name:
                    {{$parents->user->name}}
                </label>
                <br>

                <label> Parent Email:
                    {{$parents->user->email}}
                </label>
                <br>


                <label> Phone:
                    {{$parents->phone}}
                </label>
                <br>

                <label> Gender:
                    {{$parents->gender}}
                </label>
                <br>

                <label> Date of Birth:
                    {{\Carbon\Carbon::parse($parents->dateOfbirth)->format('d/m/y')}}
                </label>
                <br>


                <label> Current Address:
                    {{$parents->current_address}}
                </label>
                <br>


                <label> Permanent Address:
                    {{$parents->permanent_address}}

                </label>
                <br>

                <div class="row">
                    <a href="{{url("/parents/{$parents->id}/edit")}}"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-3 rounded"
                        style="text-decoration: none" type="submit">Edit Parent</a>
                    <form action="{{route('parents.destroy',$parents->id)}}" method="POST"
                        onsubmit="return confirm('Do you want to delete ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" style="display: inline; margin-left:3px" type="submit">Delete Parent</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

