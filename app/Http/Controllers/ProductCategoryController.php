<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories = ProductCategory::all();
        return view('products.category.index', compact('product_categories'));
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
        // Validation Data
        $request->validate([
            'category_name' => 'required|unique:product_categories',
        ]);

        $category = new ProductCategory();
        $category->category_name = $request->category_name;
        $category->save();

        session()->flash('success', 'Product Category stored successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        $product_subcategories = ProductSubcategory::where('category_id', $category->id)
            ->get();
        $categories = ProductCategory::all();

        return view('products.subcategory.index', compact('category', 'product_subcategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        // Validation Data
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name,' . $category->id,
        ]);

        $category->category_name = $request->category_name;
        $category->save();

        session()->flash('success', 'Product Category updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        session()->flash('success', 'Product Category deleted successfully!');
        return redirect()->back();
    }
}
