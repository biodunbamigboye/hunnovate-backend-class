@props(['title' => 'Places'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · Places</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <nav aria-label="Main navigation" class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <a href="{{ route('places.index') }}" class="text-xl font-bold tracking-tight">Places<span class="text-indigo-600">.</span></a>
            @can('manage-places')
                <a href="{{ route('admin.places.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">Manage places</a>
            @else
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:underline">Admin log in</a>
                @endguest
            @endcan
        </nav>
    </header>
    <main class="mx-auto max-w-6xl px-6 py-10">
        {{ $slot }}
    </main>
</body>
</html>
