<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Contracts\View\View;

class PlaceDirectoryController extends Controller
{
    public function index(): View
    {
        return view('places.directory', ['places' => Place::query()->latest('id')->paginate(15)]);
    }

    public function show(Place $place): View
    {
        return view('places.show', compact('place'));
    }
}
