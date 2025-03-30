<!-- resources/views/admin/users.blade.php -->
@extends('layouts/admin')
@section('content')

<h2 class="text-xl font-bold">Hello {{Auth::user()->username}} Webcome To Dashboard</h2>

@endsection