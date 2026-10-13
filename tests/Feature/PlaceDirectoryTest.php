<?php

use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('guests can browse every place across directory pages', function () {
    $oldestPlace = Place::factory()->create(['name' => 'Oldest place']);
    Place::factory()->count(14)->create();
    $newestPlace = Place::factory()->create(['name' => 'Newest place', 'description' => 'Local history', 'address' => '10 Main Street']);

    $response = $this->get('/places');

    $response->assertSee('16 places')->assertSee($newestPlace->name)
        ->assertSee('Local history')->assertSee('10 Main Street')
        ->assertSee(route('places.show', $newestPlace))
        ->assertDontSee($oldestPlace->name)->assertDontSee('Edit')->assertDontSee('Delete');

    $this->get('/places?page=2')->assertSee($oldestPlace->name)->assertDontSee($newestPlace->name);
});

test('an empty directory shows a helpful message', function () {
    $this->get('/places')->assertSee('No places yet. Check back soon.');
});

test('guests can view the full details of a place', function () {
    $place = Place::factory()->create([
        'name' => 'Lagos Library',
        'description' => str_repeat('Local history. ', 20),
        'address' => '10 Main Street',
        'lat' => 6.5244,
        'lng' => 3.3792,
    ]);

    $response = $this->get('/places/'.$place->id);

    $response->assertSee($place->name)->assertSee($place->description)
        ->assertSee($place->address)->assertSee('6.5244000')->assertSee('3.3792000')
        ->assertSee(route('places.index'))->assertDontSee('Edit')->assertDontSee('Delete');
});

test('places without optional details show fallbacks', function () {
    $place = Place::factory()->create();

    $response = $this->get(route('places.show', $place));

    $response->assertSee('No description available.')->assertSee('Address not provided.')->assertSee('Not provided');
});

test('zero coordinates are displayed as coordinates', function () {
    $place = Place::factory()->create(['lat' => 0, 'lng' => 0]);

    $this->get(route('places.show', $place))->assertSee('0.0000000')->assertDontSee('Not provided');
});

test('public place pages escape user supplied content', function (bool $showDetails) {
    $place = Place::factory()->create([
        'name' => '<script>alert(1)</script>',
        'description' => '<script>alert(2)</script>',
        'address' => '<script>alert(3)</script>',
    ]);

    $response = $this->get($showDetails ? route('places.show', $place) : route('places.index'));

    $response->assertSee($place->name)->assertSee($place->description)->assertSee($place->address)
        ->assertDontSee('<script>alert(', false);
})->with(['directory' => false, 'detail' => true]);

test('a missing public place returns not found', function () {
    $this->get('/places/999')->assertNotFound();
});

test('non admins can browse the public place pages', function (bool $showDetails) {
    $user = User::factory()->create();
    $place = Place::factory()->create();

    $response = $this->actingAs($user)->get($showDetails ? route('places.show', $place) : route('places.index'));

    $response->assertSee($place->name)->assertDontSee('Manage places');
})->with(['directory' => false, 'detail' => true]);

test('admins can reach management from the public directory', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)->get(route('places.index'))->assertSee(route('admin.places.index'));
});

test('the dashboard redirects admins to the management listing', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)->get(route('dashboard'))->assertRedirect(route('admin.places.index'));
});
