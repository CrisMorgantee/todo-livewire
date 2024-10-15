<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-slate-900">
    <header class="grid place-items-center h-48 bg-slate-800 md:h-52">
      <img src="{{ asset('assets/logo.svg') }}" alt="Logo" class="w-32 text-slate-400 mb-4">
    </header>
        {{ $slot }}
    </body>
</html>
