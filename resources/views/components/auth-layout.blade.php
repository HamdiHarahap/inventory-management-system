<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Login' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        {{ $slot }}
    </div>
</body>
</html>
