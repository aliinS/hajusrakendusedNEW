<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($validated);

        return redirect()->route('products.index');
    }


    public function show()
    {
        $product = Product::all();
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        
        return view('products.edit', [
            'product' => $product,
        ]);
        
    }


    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'string|max:255',
        'description' => 'string',
        'price' => 'numeric|min:0',
        'file' => '',
    ]);

    $product = Product::findOrFail($id);
    
    $product->update($validated);

    return redirect()->route('products.index');
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted!');
    }

}
