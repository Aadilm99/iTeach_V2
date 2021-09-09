@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Login as Teacher, Parent or Admin</h1>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
    @role('Admin')
    @include('dashboard_panel.admin')
    @endrole

    @role('Teacher')
    @include('dashboard_panel.teacher')
    @endrole

    @role('Parent')
    @include('dashboard_panel.parents'){{--  --}}
    @endrole
</div>
@endsection
