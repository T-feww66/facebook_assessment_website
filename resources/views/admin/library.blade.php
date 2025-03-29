<!-- resources/views/admin/users.blade.php -->
@extends('layouts/admin')
@section('content')
<h2 class="text-xl font-bold">Manage Library</h2>
<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Example row -->
        <tr>
            <td class="border px-4 py-2">1</td>
            <td class="border px-4 py-2">John Doe</td>
            <td class="border px-4 py-2">john@example.com</td>
            <td class="border px-4 py-2">
                <button class="bg-yellow-500 text-white px-2 py-1 rounded cursor-pointer">Edit</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded cursor-pointer">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
@endsection