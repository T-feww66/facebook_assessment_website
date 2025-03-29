<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 text-white p-6">
        <a href="{{ route('admin.home') }}">
            <h2 class="text-2xl font-bold">Admin Panel</h2>
        </a>
        <nav class="mt-6">
            <ul>
                <li class="mt-2"><a href="{{ route('admin.users') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Manage Users</a></li>
                <li class="mt-2"><a href="{{ route('admin.pages') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Manage Pages</a></li>
                <li class="mt-2"><a href="{{ route('admin.posts') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Manage Posts</a></li>
                <li class="mt-2"><a href="{{ route('admin.library') }}" class="block py-2 px-4 rounded hover:bg-blue-700">File Library</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>

</html>