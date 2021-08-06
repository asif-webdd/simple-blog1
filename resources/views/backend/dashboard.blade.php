@extends('backend.app')
@section('title', 'Dashboard')

@section('main-content')
    <h1>Dashboard - <span style="color: green; text-transform: uppercase;">{{ auth()->user()->firstName }}</span></h1>

@endsection









