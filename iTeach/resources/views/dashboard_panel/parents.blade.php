@extends('layouts.master')

@section('content')

<h1>Hello, {{Auth::user()->name}}</h1>


@endsection

