<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rental;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin,admin_toko,admin_kontrakan,kasir');
    }

    public function index()
    {
        $data = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_rentals' => Rental::count(),
            'available_rentals' => Rental::where('status', 'available')->count(),
        ];

        return view('admin.dashboard', $data);
    }
}
