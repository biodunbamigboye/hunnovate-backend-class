<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlaceRequest;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function edit(Place $place): View
    {
        return view('places.form', compact('place'));
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
