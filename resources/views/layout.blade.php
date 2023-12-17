<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{ asset('js/auth.js') }}" defer></script>
    <script src="{{ asset('js/trigger_form_on_select.js') }}" defer></script>

    <title>Kursinis</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-primary">
    @yield('content')

    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    @yield('scripts')

    @yield('preloadClasses')
</body>
</html>
