<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{ asset('js/auth.js') }}" defer></script>
    <script src="{{ asset('js/trigger_form_on_select.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <title>Kursinis</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-primary relative">
    {{-- response message box --}}
    @if (session('status'))
    <div id="message-box" class="fixed top-[35%] left-[45%] px-[48px] py-[24px] bg-tertiary rounded-md border-4 border-primary opacity-80 z-50 message-box">
            <span class="text-blue-700 font-bold">{{ session('status') }}</span>
    </div>
    @endif

    @yield('content')

    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    @yield('scripts')

    @yield('preloadClasses')
</body>
</html>
