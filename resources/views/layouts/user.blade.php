<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <!-- Sử dụng Bootstrap 5 -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <!-- Header -->
    @include("user.includes.header")
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    @include("user.includes.footer")
</body>

</html>