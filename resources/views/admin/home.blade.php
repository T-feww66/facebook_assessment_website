@extends('layouts.admin')

@section("title", "Admin Dashboard")
@section("header", "Dashboard")

@section('content')
<h2 class="text-xl font-bold">Hello {{Auth::user()->username}} Webcome To Dashboard</h2>

@endsection