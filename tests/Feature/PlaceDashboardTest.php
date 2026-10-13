<?php

use App\Models\Place;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('guests cannot access any place management route', function (string $method, string $path) {
    $this->{$method}($path)->assertRedirect(route('login'));
})->with([
    ['get', '/dashboard/places'], ['get', '/dashboard/places/create'], ['post', '/dashboard/places'],
    ['get', '/dashboard/places/1/edit'], ['put', '/dashboard/places/1'], ['delete', '/dashboard/places/1'], ['get', '/dashboard'],
]);

test('non admins cannot access the dashboard or change places', function (string $method, string $path) {
    $user = User::factory()->create();
    Place::factory()->create(['id' => 1]);

    $this->actingAs($user)->{$method}($path)->assertForbidden();
})->with([['get', '/dashboard/places'], ['post', '/dashboard/places'], ['put', '/dashboard/places/1'], ['delete', '/dashboard/places/1']]);

test('admins can log in and log out', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $this->get(route('login'))->assertSee('Welcome back');

    $this->post(route('login.store'), ['email' => $admin->email, 'password' => 'password'])
        ->assertRedirect(route('admin.places.index'));
    $this->assertAuthenticatedAs($admin);

    $this->post(route('logout'))->assertRedirect(route('login'));
    $this->assertGuest();
});

test('invalid passwords and non admin accounts cannot log in', function (bool $isAdmin, string $password) {
    $user = User::factory()->create(['is_admin' => $isAdmin]);

    $this->from(route('login'))->post(route('login.store'), ['email' => $user->email, 'password' => $password])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors(['email' => 'The provided credentials do not match our records.']);
    $this->assertGuest();
})->with([[true, 'wrong-password'], [false, 'password']]);

test('login attempts are rate limited', function () {
    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), ['email' => 'unknown@example.com', 'password' => 'wrong']);
    }

    $this->post(route('login.store'), ['email' => 'unknown@example.com', 'password' => 'wrong'])->assertTooManyRequests();
});

test('admins can create a place with only a name', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $this->actingAs($admin)->get(route('admin.places.create'))->assertSee('Add a place');

    $this->post(route('admin.places.store'), ['name' => 'Lagos Library', 'id' => 999])
        ->assertRedirect(route('admin.places.index'));
    $this->assertDatabaseHas('places', [
        'name' => 'Lagos Library', 'description' => null, 'address' => null, 'lat' => null, 'lng' => null,
    ]);
    $this->assertDatabaseMissing('places', ['id' => 999]);
});

test('admins can update all fields and clear optional fields', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $place = Place::factory()->create();
    $this->actingAs($admin)->get(route('admin.places.edit', $place))->assertSee($place->name);
    $payload = ['name' => 'Museum', 'description' => 'Local history', 'address' => '10 Main Street', 'lat' => 6.5244, 'lng' => 3.3792];

    $this->put(route('admin.places.update', $place), $payload)->assertRedirect(route('admin.places.index'));
    $this->assertDatabaseHas('places', ['id' => $place->id, ...$payload]);

    $this->put(route('admin.places.update', $place), ['name' => 'Museum', 'description' => '', 'address' => '', 'lat' => '', 'lng' => ''])
        ->assertRedirect(route('admin.places.index'));
    $this->assertDatabaseHas('places', ['id' => $place->id, 'description' => null, 'address' => null, 'lat' => null, 'lng' => null]);
});

test('invalid places are rejected without saving', function (array $payload, string $field) {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)->post(route('admin.places.store'), $payload)->assertSessionHasErrors($field);
    $this->assertDatabaseCount('places', 0);
})->with([
    'missing name' => [[], 'name'],
    'blank name' => [['name' => '   '], 'name'],
    'long name' => [['name' => str_repeat('a', 256)], 'name'],
    'invalid description' => [['name' => 'Museum', 'description' => []], 'description'],
    'long address' => [['name' => 'Museum', 'address' => str_repeat('a', 256)], 'address'],
    'invalid latitude' => [['name' => 'Museum', 'lat' => 'north'], 'lat'],
    'latitude above range' => [['name' => 'Museum', 'lat' => 91], 'lat'],
    'latitude below range' => [['name' => 'Museum', 'lat' => -91], 'lat'],
    'longitude above range' => [['name' => 'Museum', 'lng' => 181], 'lng'],
    'longitude below range' => [['name' => 'Museum', 'lng' => -181], 'lng'],
]);

test('invalid updates preserve existing places', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $place = Place::factory()->create();

    $this->actingAs($admin)->put(route('admin.places.update', $place), ['name' => ''])->assertSessionHasErrors('name');
    $this->assertDatabaseHas('places', ['id' => $place->id, 'name' => $place->name]);
});

test('the dashboard escapes place content and paginates results', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    Place::factory()->count(15)->create();
    $place = Place::factory()->create(['name' => '<script>alert(1)</script>', 'description' => '<script>alert(2)</script>', 'address' => '<script>alert(3)</script>']);

    $response = $this->actingAs($admin)->get(route('admin.places.index'));

    $response->assertSee($place->name)->assertSee($place->description)->assertSee($place->address)
        ->assertDontSee('<script>alert(', false)->assertSee('16 places');
    expect($response->viewData('places')->count())->toBe(15);
});

test('admins can delete places', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $place = Place::factory()->create();

    $this->actingAs($admin)->delete(route('admin.places.destroy', $place))->assertRedirect(route('admin.places.index'));
    $this->assertModelMissing($place);
});

test('missing places return not found', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)->get('/dashboard/places/999/edit')->assertNotFound();
});

test('seeding creates an admin and preserves the password on subsequent runs', function () {
    $this->seed(AdminUserSeeder::class);
    $admin = User::where('email', 'admin@example.com')->firstOrFail();
    $password = $admin->password;
    expect($admin->is_admin)->toBeTrue();

    $this->seed(AdminUserSeeder::class);

    $this->assertDatabaseCount('users', 1);
    expect($admin->fresh()->password)->toBe($password);
});
