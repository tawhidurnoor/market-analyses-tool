<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSubcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
            ->selectRaw('products.*, product_subcategories.subcategory_name as subcategory_name')
            ->get();
        $subcategories = ProductSubcategory::all();
        return view('products.list.index', compact('products', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_subcat_id = $request->product_subcat_id;
        $product->mrp = $request->mrp;

        $product->save();

        session()->flash('success', 'Product stored successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->product_name = $request->product_name;
        $product->product_subcat_id = $request->product_subcat_id;
        $product->mrp = $request->mrp;

        $product->save();

        session()->flash('success', 'Product Updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('success', 'Product deleted successfully!');
        return redirect()->back();
    }
}
