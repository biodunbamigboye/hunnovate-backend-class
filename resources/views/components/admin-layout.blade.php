@props(['title' => 'Places'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · Places dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-5">
            <a href="{{ route('places.index') }}" class="text-xl font-bold tracking-tight">Places<span class="text-indigo-600">.</span></a>
            @can('manage-places')
                <a href="{{ route('admin.places.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">Manage places</a>
            @endcan
            @auth
                <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <span class="hidden text-sm text-slate-500 sm:inline">{{ auth()->user()->name }}</span>
                    <button class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-100">Log out</button>
                </form>
            @endauth
        </div>
    </header>
    <main class="mx-auto max-w-6xl px-6 py-10">
        @if (session('success'))
            <div role="status" class="mb-6 rounded-xl bg-emerald-50 p-4 text-emerald-800">{{ session('success') }}</div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
