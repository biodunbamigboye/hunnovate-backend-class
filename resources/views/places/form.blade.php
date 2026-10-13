<x-admin-layout :title="$place->exists ? 'Edit place' : 'Add place'">
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('admin.places.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">← Back to places</a>
        <h1 class="mt-5 text-3xl font-bold">{{ $place->exists ? 'Edit place' : 'Add a place' }}</h1>
        <p class="mt-2 text-slate-500">Only the name is required. Add other details when available.</p>
        <form method="POST" action="{{ $place->exists ? route('admin.places.update', $place) : route('admin.places.store') }}" class="mt-8 flex flex-col gap-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @if ($place->exists) @method('PUT') @endif
            @foreach (['name' => 'Name', 'description' => 'Description', 'address' => 'Address', 'lat' => 'Latitude', 'lng' => 'Longitude'] as $field => $label)
                <div>
                    <label for="{{ $field }}" class="mb-2 block text-sm font-medium">{{ $label }} {{ $field === 'name' ? '*' : '(optional)' }}</label>
                    @if ($field === 'description')
                        <textarea id="{{ $field }}" name="{{ $field }}" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-indigo-600" @error($field) aria-invalid="true" aria-describedby="{{ $field }}-error" @enderror>{{ old($field, $place->{$field}) }}</textarea>
                    @else
                        <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $place->{$field}) }}" type="{{ in_array($field, ['lat', 'lng']) ? 'number' : 'text' }}" @if ($field === 'name') required maxlength="255" @elseif ($field === 'address') maxlength="255" @else step="any" min="{{ $field === 'lat' ? '-90' : '-180' }}" max="{{ $field === 'lat' ? '90' : '180' }}" @endif class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-indigo-600" @error($field) aria-invalid="true" aria-describedby="{{ $field }}-error" @enderror>
                    @endif
                    @error($field) <p id="{{ $field }}-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            @endforeach
            <div class="flex items-center gap-4 border-t border-slate-100 pt-5">
                <button class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">{{ $place->exists ? 'Save changes' : 'Create place' }}</button>
                <a href="{{ route('admin.places.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>
