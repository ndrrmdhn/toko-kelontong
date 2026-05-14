<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rental;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['landing', 'products', 'rentals']]);
    }

    public function landing()
    {
        $banners = Banner::active()->select(['id', 'title', 'description', 'image', 'button_text', 'button_link'])->get();
        $featured_products = Product::with('category:id,name')
            ->where('active', true)
            ->select(['id', 'category_id', 'name', 'image', 'price', 'stock', 'description'])
            ->latest()
            ->limit(4)
            ->get();
        $latest_products = Product::with('category:id,name')
            ->where('active', true)
            ->select(['id', 'category_id', 'name', 'image', 'price', 'stock', 'description'])
            ->latest()
            ->skip(4)
            ->limit(8)
            ->get();
        $rentals = Rental::available()->select(['id', 'name', 'description', 'price_monthly', 'price_yearly', 'status', 'images'])->limit(6)->get();
        $services = Service::where('is_active', true)->select(['id', 'name', 'description', 'icon'])->get();

        return view('landing', compact('banners', 'featured_products', 'latest_products', 'rentals', 'services'));
    }

    public function products()
    {
        $search = request('search');
        $categoryId = request('category');

        $products = Product::with('category')
            ->where('active', true)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function show(Product $product)
    {
        abort_if(! $product->active, 404);

        return view('products.show', compact('product'));
    }

    public function rentals()
    {
        $rentals = Rental::paginate(12);

        return view('rentals.index', compact('rentals'));
    }

    public function showRental(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    public function index()
    {
        return view('dashboard');
    }
}
