<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlaceRequest;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PlaceController extends Controller
{
    public function index(): View
    {
        return view('places.index', ['places' => Place::query()->latest('id')->paginate(15)]);
    }

    public function create(): View
    {
        return view('places.form', ['place' => new Place]);
    }

    public function store(SavePlaceRequest $request): RedirectResponse
    {
        Place::create($request->validated());

        return to_route('admin.places.index')->with('success', 'Place created successfully.');
    }

    public function edit(int $place): View
    {
        Log::info("Editing place with ID: $place");
        $place = Place::query()->findOrFail($place);

        return view('places.detail', ['place' => $place]);
    }

    public function update(SavePlaceRequest $request, Place $place): RedirectResponse
    {
        $place->update($request->validated());

        return to_route('admin.places.index')->with('success', 'Place updated successfully.');
    }

    public function destroy(Place $place): RedirectResponse
    {
        $place->delete();

        return to_route('admin.places.index')->with('success', 'Place deleted successfully.');
    }
}
