@extends('layouts.admin')
@section("header", "Dashboard")

@section('content')
<h2 class="text-xl font-bold text-black">Hello {{Auth::id()}} Webcome To Dashboard</h2>

@endsection