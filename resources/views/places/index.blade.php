<x-admin-layout>
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-indigo-600">Dashboard</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight">Your places</h1>
            <p class="mt-2 text-slate-500">{{ $places->total() }} {{ Str::plural('place', $places->total()) }} in your directory</p>
        </div>
        <a href="{{ route('admin.places.create') }}" class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">+ Add place</a>
    </div>
    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    @foreach (['Name', 'Description', 'Address', 'Lat', 'Lng', 'Actions'] as $heading)
                        <th scope="col" class="px-5 py-4 font-medium">{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($places as $place)
                    <tr>
                        <td class="px-5 py-4 font-semibold"><a href="{{ route('places.show', $place) }}" class="text-indigo-600 hover:underline">{{ $place->name }}</a></td>
                        <td class="max-w-xs px-5 py-4 text-slate-500">{{ Str::limit($place->description, 100) ?: '—' }}</td>
                        <td class="px-5 py-4 text-slate-500">{{ $place->address ?: '—' }}</td>
                        <td class="px-5 py-4 tabular-nums">{{ $place->lat ?? '—' }}</td>
                        <td class="px-5 py-4 tabular-nums">{{ $place->lng ?? '—' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.places.edit', $place) }}" class="font-medium text-indigo-600 hover:underline" aria-label="Edit {{ $place->name }}">Edit</a>
                                <form method="POST" action="{{ route('admin.places.destroy', $place) }}" onsubmit="return confirm('Delete this place? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-medium text-red-600 hover:underline" aria-label="Delete {{ $place->name }}">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-16 text-center text-slate-500">No places yet. Add your first place to get started.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $places->links() }}</div>
</x-admin-layout>
