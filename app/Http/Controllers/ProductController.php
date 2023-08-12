<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::all();
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::create($request->all());

        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::get();
        // $product = Product::get(['name']);
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return response()->json(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        // echo $id;
        $product = Product::where('id',$id);
        // echo $product;
        $product->delete();
        // return Redirect::back()->with('msg', 'The Message');
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
