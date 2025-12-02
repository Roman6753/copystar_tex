<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite('resources/css/app.css')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
</head>

<body class="grid grid-cols-[1fr_4fr] h-screen">
    <aside class="bg-black text-white ">
        <h2>Боковое меню</h2>
        <ul>
            <li><a href="{{ route('dashboard.category') }}">Category</a></li>
            <li><a href="{{ route('dashboard.country') }}">Country</a></li>
            <li><a href="{{ route('dashboard.user') }}">Users</a></li>
            <li><a href="{{ route('dashboard.product') }}">Product</a></li>
        </ul>
    </aside>
    <div class="container flex flex-col">
        <header class="bg-amber-200">
            <a href="{{ route('home') }}" wire:navigate>Home</a>
        </header>
        <main class="flex-grow">
            {{ $slot }}
        </main>
        <footer class="bg-blue-200">
            footer
        </footer>
    </div>

</body>

</html>
