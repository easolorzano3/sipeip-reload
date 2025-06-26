<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIPEIP Reload')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Puedes usar Bootstrap desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">SIPEIP Reload</h1>
        @yield('content')
    </div>
</body>
</html>
