<x-places-layout :title="$place->name">
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('places.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">← Back to all places</a>
        <article class="mt-6 flex flex-col gap-8 rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-3xl font-bold tracking-tight wrap-break-word">{{ $place->name }}</h1>
            <section aria-labelledby="description-heading">
                <h2 id="description-heading" class="text-lg font-semibold">About this place</h2>
                <p class="mt-3 whitespace-pre-line leading-relaxed text-slate-600 wrap-break-word">{{ $place->description ?: 'No description available.' }}</p>
            </section>
            <section aria-labelledby="location-heading" class="border-t border-slate-100 pt-6">
                <h2 id="location-heading" class="text-lg font-semibold">Location</h2>
                <dl class="mt-4 grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-slate-500">Address</dt>
                        <dd class="mt-1 whitespace-pre-line wrap-break-word">{{ $place->address ?: 'Address not provided.' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Latitude</dt>
                        <dd class="mt-1 tabular-nums">{{ $place->lat ?? 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Longitude</dt>
                        <dd class="mt-1 tabular-nums">{{ $place->lng ?? 'Not provided' }}</dd>
                    </div>
                </dl>
            </section>
        </article>
    </div>
</x-places-layout>
