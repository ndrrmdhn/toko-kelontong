<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('admin can create a product with image upload', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);
    $category = Category::create(['name' => 'Test Category']);

    $this->actingAs($user)
        ->post(route('admin.products.store'), [
            'name' => 'Produk Test',
            'description' => 'Deskripsi produk test',
            'price' => 15000,
            'stock' => 10,
            'category_id' => $category->id,
            'expired_date' => now()->addDays(30)->toDateString(),
            'whatsapp_message' => 'Saya ingin memesan produk test.',
            'active' => '1',
            'image' => UploadedFile::fake()->image('product.jpg'),
        ])
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('success');

    $product = Product::where('name', 'Produk Test')->first();

    expect($product)->not->toBeNull();
    Storage::disk('public')->assertExists($product->image);
});

test('admin can update a product and replace the old image', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);
    $category = Category::create(['name' => 'Test Category']);
    $oldImage = UploadedFile::fake()->image('old.jpg');
    $oldPath = $oldImage->store('products', 'public');

    $product = Product::create([
        'name' => 'Produk Lama',
        'description' => 'Deskripsi lama',
        'price' => 12000,
        'stock' => 5,
        'category_id' => $category->id,
        'expired_date' => now()->addDays(20)->toDateString(),
        'whatsapp_message' => 'Pesan lama',
        'active' => true,
        'image' => $oldPath,
    ]);

    $newImage = UploadedFile::fake()->image('new.jpg');

    $this->actingAs($user)
        ->put(route('admin.products.update', $product), [
            'name' => 'Produk Lama Update',
            'description' => 'Deskripsi baru',
            'price' => 18000,
            'stock' => 8,
            'category_id' => $category->id,
            'expired_date' => now()->addDays(45)->toDateString(),
            'whatsapp_message' => 'Pesan baru',
            'active' => '1',
            'image' => $newImage,
        ])
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('success');

    $product->refresh();

    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists($product->image);
    expect($product->name)->toBe('Produk Lama Update');
});

test('admin can delete a product and its image is removed', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'super_admin']);
    $category = Category::create(['name' => 'Test Category']);
    $image = UploadedFile::fake()->image('delete.jpg');
    $path = $image->store('products', 'public');

    $product = Product::create([
        'name' => 'Produk Delete',
        'description' => 'Deskripsi delete',
        'price' => 9000,
        'stock' => 2,
        'category_id' => $category->id,
        'expired_date' => now()->addDays(10)->toDateString(),
        'whatsapp_message' => 'Pesan delete',
        'active' => true,
        'image' => $path,
    ]);

    $this->actingAs($user)
        ->delete(route('admin.products.destroy', $product))
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHas('success');

    expect(Product::find($product->id))->toBeNull();
    Storage::disk('public')->assertMissing($path);
});

test('product creation validation returns messages and old input is preserved', function () {
    $user = User::factory()->create(['role' => 'super_admin']);
    $category = Category::create(['name' => 'Test Category']);

    $response = $this->actingAs($user)
        ->from(route('admin.products.create'))
        ->post(route('admin.products.store'), [
            'name' => '',
            'price' => 'not-a-number',
            'stock' => -1,
            'category_id' => '',
        ]);

    $response->assertRedirect(route('admin.products.create'));
    $response->assertSessionHasErrors(['name', 'price', 'stock', 'category_id']);
});

test('product search and category filter work in admin index', function () {
    $user = User::factory()->create(['role' => 'super_admin']);
    $categoryA = Category::create(['name' => 'Category A']);
    $categoryB = Category::create(['name' => 'Category B']);

    Product::create([
        'name' => 'Searchable Product',
        'description' => 'Some matching description',
        'price' => 10000,
        'stock' => 5,
        'category_id' => $categoryA->id,
        'expired_date' => null,
        'whatsapp_message' => 'Test',
        'active' => true,
    ]);

    Product::create([
        'name' => 'Other Product',
        'description' => 'Different text',
        'price' => 15000,
        'stock' => 3,
        'category_id' => $categoryB->id,
        'expired_date' => null,
        'whatsapp_message' => 'Test',
        'active' => true,
    ]);

    $this->actingAs($user)
        ->get(route('admin.products.index', ['search' => 'Searchable']))
        ->assertSee('Searchable Product')
        ->assertDontSee('Other Product');

    $this->actingAs($user)
        ->get(route('admin.products.index', ['category' => $categoryB->id]))
        ->assertSee('Other Product')
        ->assertDontSee('Searchable Product');
});
