<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ================= ADMIN PRODUCT LIST =================
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // ================= CREATE FORM =================
    public function create()
    {
        return view('products.create');
    }

    // ================= STORE PRODUCT =================
    public function store(Request $request)
    {
        $imageName = null;

        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return back()->with('success', 'Product added successfully');
    }

    // ================= FRONT SHOP PAGE =================
    public function shop()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    // ================= EDIT FORM =================
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // ================= UPDATE PRODUCT =================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $imageName = $product->image;

        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return back()->with('success', 'Product updated successfully');
    }

    // ================= DELETE PRODUCT =================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully');
    }

    // ================= SHOW SINGLE PRODUCT (FRONT PAGE) =================
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}