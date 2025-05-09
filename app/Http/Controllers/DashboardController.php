<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sort_by' => 'nullable|in:price,name,stock',
            'sort_dir' => 'nullable|in:asc,desc'
        ]);
        $sortBy = $validated['sort_by'] ?? 'created_at';
        $sortDir = $validated['sort_dir'] ?? 'desc';
        $products = Product::orderBy($sortBy, $sortDir)->paginate(7);
        return view('dashboard', compact('products', 'sortBy', 'sortDir'));
    }
}
