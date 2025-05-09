<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =  Product::orderBy('id', 'desc')->paginate(7);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store("products", 'public');
            $data['photo'] = $path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('status', 'Product was successfully created!');
    }

    public function show(Product $product)
    {
        return view('client.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($product->photo && (empty($request['current_photo']) || $request->hasFile('photo'))){
            Storage::disk('public')->delete($product->photo);
            $data['photo'] = "";
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store("products", 'public');
            $data['photo'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Product was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index', absolute: false))->with('status', 'Product was successfully deleted!');
    }
}
