<!-- resources/views/admin/users.blade.php -->
@extends('layouts.admin')
@section('content')
<h2 class="h2 fw-bold">Manage Pages</h2>
<table class="table table-bordered mt-4">
    <thead class="table-light">
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Example row -->
        <tr>
            <td class="px-4 py-2">1</td>
            <td class="px-4 py-2">John Doe</td>
            <td class="px-4 py-2">john@example.com</td>
            <td class="px-4 py-2">
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
@endsection