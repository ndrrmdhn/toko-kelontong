<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin,admin_toko');
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $rentals = Rental::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('whatsapp_message', 'like', "%{$search}%");
        })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Kontrakan']
        ];

        return view('admin.rentals.index', compact('rentals', 'search', 'status', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Kontrakan', 'url' => route('admin.rentals.index')],
            ['title' => 'Tambah Kontrakan']
        ];

        return view('admin.rentals.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:255',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['available', 'rented'])],
            'whatsapp_message' => 'nullable|string|max:500',
        ]);

        $data = $request->only(['name', 'description', 'price_monthly', 'price_yearly', 'facilities', 'status', 'whatsapp_message']);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('rentals', 'public');
            }
            $data['images'] = $images;
        }

        Rental::create($data);

        return redirect()->route('admin.rentals.index')
            ->with('success', '✅ Kontrakan berhasil ditambahkan!');
    }

    public function edit(Rental $rental)
    {
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Kontrakan', 'url' => route('admin.rentals.index')],
            ['title' => 'Edit: ' . $rental->name]
        ];

        return view('admin.rentals.edit', compact('rental', 'breadcrumbs'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:255',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['available', 'rented'])],
            'whatsapp_message' => 'nullable|string|max:500',
        ]);

        $data = $request->only(['name', 'description', 'price_monthly', 'price_yearly', 'facilities', 'status', 'whatsapp_message']);

        if ($request->hasFile('images')) {
            // Delete old images
            if ($rental->images) {
                foreach ($rental->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Store new images
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('rentals', 'public');
            }
            $data['images'] = $images;
        }

        $rental->update($data);

        return redirect()->route('admin.rentals.index')
            ->with('success', '✅ Kontrakan berhasil diperbarui!');
    }

    public function destroy(Rental $rental)
    {
        if ($rental->images) {
            foreach ($rental->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $rental->delete();

        return redirect()->route('admin.rentals.index')
            ->with('success', '✅ Kontrakan berhasil dihapus!');
    }
}
