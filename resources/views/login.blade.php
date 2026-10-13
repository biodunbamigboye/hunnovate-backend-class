<x-admin-layout title="Log in">
    <section class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-bold">Welcome back</h1>
        <p class="mt-2 text-sm text-slate-500">Log in to manage your places.</p>
        <form method="POST" action="{{ route('login.store') }}" class="mt-8 flex flex-col gap-5">
            @csrf
            <div>
                <label for="email" class="mb-2 block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-indigo-600" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email') <p id="email-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password" class="mb-2 block text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-indigo-600" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password') <p id="password-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <button class="rounded-lg bg-indigo-600 px-4 py-3 font-medium text-white hover:bg-indigo-700">Log in</button>
        </form>
    </section>
</x-admin-layout>
