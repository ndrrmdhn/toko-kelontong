<?php

use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('admin can create a rental with multiple images upload', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);

    $this->actingAs($user)
        ->post(route('admin.rentals.store'), [
            'name' => 'Kontrakan Test',
            'description' => 'Deskripsi kontrakan test',
            'price_monthly' => 1500000,
            'price_yearly' => 15000000,
            'facilities' => ['WiFi', 'AC', 'Parkir'],
            'status' => 'available',
            'whatsapp_message' => 'Saya ingin menanyakan kontrakan test.',
            'images' => [
                UploadedFile::fake()->image('rental1.jpg'),
                UploadedFile::fake()->image('rental2.jpg'),
            ],
        ])
        ->assertRedirect(route('admin.rentals.index'))
        ->assertSessionHas('success');

    $rental = Rental::where('name', 'Kontrakan Test')->first();

    expect($rental)->not->toBeNull();
    expect($rental->images)->toHaveCount(2);
    Storage::disk('public')->assertExists($rental->images[0]);
    Storage::disk('public')->assertExists($rental->images[1]);
});

test('admin can update a rental and replace images', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);
    $oldImages = [
        UploadedFile::fake()->image('old1.jpg')->store('rentals', 'public'),
        UploadedFile::fake()->image('old2.jpg')->store('rentals', 'public'),
    ];

    $rental = Rental::create([
        'name' => 'Kontrakan Lama',
        'description' => 'Deskripsi lama',
        'price_monthly' => 1200000,
        'facilities' => ['WiFi'],
        'images' => $oldImages,
        'status' => 'available',
        'whatsapp_message' => 'Pesan lama',
    ]);

    $newImages = [
        UploadedFile::fake()->image('new1.jpg'),
        UploadedFile::fake()->image('new2.jpg'),
        UploadedFile::fake()->image('new3.jpg'),
    ];

    $this->actingAs($user)
        ->put(route('admin.rentals.update', $rental), [
            'name' => 'Kontrakan Lama Update',
            'description' => 'Deskripsi baru',
            'price_monthly' => 1800000,
            'facilities' => ['WiFi', 'AC', 'Parkir', 'Dapur'],
            'status' => 'rented',
            'whatsapp_message' => 'Pesan baru',
            'images' => $newImages,
        ])
        ->assertRedirect(route('admin.rentals.index'))
        ->assertSessionHas('success');

    $rental->refresh();

    Storage::disk('public')->assertMissing($oldImages[0]);
    Storage::disk('public')->assertMissing($oldImages[1]);
    expect($rental->images)->toHaveCount(3);
    expect($rental->name)->toBe('Kontrakan Lama Update');
    expect($rental->facilities)->toBe(['WiFi', 'AC', 'Parkir', 'Dapur']);
});

test('admin can delete a rental and its images are removed', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);
    $images = [
        UploadedFile::fake()->image('delete1.jpg')->store('rentals', 'public'),
        UploadedFile::fake()->image('delete2.jpg')->store('rentals', 'public'),
    ];

    $rental = Rental::create([
        'name' => 'Kontrakan Delete',
        'description' => 'Deskripsi delete',
        'price_monthly' => 900000,
        'facilities' => ['WiFi'],
        'images' => $images,
        'status' => 'available',
        'whatsapp_message' => 'Pesan delete',
    ]);

    $this->actingAs($user)
        ->delete(route('admin.rentals.destroy', $rental))
        ->assertRedirect(route('admin.rentals.index'))
        ->assertSessionHas('success');

    expect(Rental::find($rental->id))->toBeNull();
    Storage::disk('public')->assertMissing($images[0]);
    Storage::disk('public')->assertMissing($images[1]);
});

test('rental creation validation returns messages and old input is preserved', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    $response = $this->actingAs($user)
        ->from(route('admin.rentals.create'))
        ->post(route('admin.rentals.store'), [
            'name' => '',
            'price_monthly' => 'not-a-number',
            'status' => 'invalid-status',
        ]);

    $response->assertRedirect(route('admin.rentals.create'));
    $response->assertSessionHasErrors(['name', 'price_monthly', 'status']);
});

test('rental search and status filter work in admin index', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    Rental::create([
        'name' => 'Kontrakan Searchable',
        'description' => 'Some matching description',
        'price_monthly' => 1000000,
        'facilities' => ['WiFi'],
        'status' => 'available',
        'whatsapp_message' => 'Test',
    ]);

    Rental::create([
        'name' => 'Other Rental',
        'description' => 'Different text',
        'price_monthly' => 1500000,
        'facilities' => ['AC'],
        'status' => 'rented',
        'whatsapp_message' => 'Test',
    ]);

    $this->actingAs($user)
        ->get(route('admin.rentals.index', ['search' => 'Searchable']))
        ->assertSee('Kontrakan Searchable')
        ->assertDontSee('Other Rental');

    $this->actingAs($user)
        ->get(route('admin.rentals.index', ['status' => 'rented']))
        ->assertSee('Other Rental')
        ->assertDontSee('Kontrakan Searchable');
});
