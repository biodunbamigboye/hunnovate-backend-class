<x-places-layout title="All places">
    <div class="mb-8">
        <p class="text-sm font-medium text-indigo-600">Directory</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight">All places</h1>
        <p class="mt-2 text-slate-500">Explore {{ $places->total() }} {{ Str::plural('place', $places->total()) }} in the directory.</p>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($places as $place)
            <article class="flex flex-col gap-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold wrap-break-word">
                    <a href="{{ route('places.show', $place) }}" class="text-indigo-600 hover:underline">{{ $place->name }}</a>
                </h2>
                <p class="text-sm leading-relaxed text-slate-600 wrap-break-word">{{ Str::limit($place->description, 160) ?: 'No description available.' }}</p>
                <p class="text-sm text-slate-500 wrap-break-word">{{ $place->address ?: 'Address not provided.' }}</p>
                <a href="{{ route('places.show', $place) }}" class="mt-auto text-sm font-semibold text-indigo-600 hover:underline" aria-label="View details for {{ $place->name }}">View details →</a>
            </article>
        @empty
            <p class="rounded-xl border border-slate-200 bg-white px-6 py-16 text-center text-slate-500 sm:col-span-2 lg:col-span-3">No places yet. Check back soon.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $places->links() }}</div>
</x-places-layout>
