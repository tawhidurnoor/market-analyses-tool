<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSubcategory;
use Illuminate\Http\Request;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'subcategory_name' => 'required|unique:product_subcategories',
        ]);

        $subcategory = new ProductSubcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();

        session()->flash('success', 'Product Subcategory stored successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubcategory $subcategory)
    {
        return $subcategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSubcategory $productSubcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSubcategory $subcategory)
    {
        // Validation Data
        $request->validate([
            'subcategory_name' => 'required|unique:product_subcategories,subcategory_name,' . $subcategory->id,
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();

        session()->flash(
            'success',
            'Product Subcategory updated successfully!'
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSubcategory $subcategory)
    {
        $product_counter = Product::where('product_subcat_id', $subcategory->id)->count();
        if ($product_counter > 0) {
            if ($product_counter == 1) {
                session()->flash('warning', 'You can not delete ' . $subcategory->subcategory_name . '! It has 1 product.');
                return redirect()->back();
            } else {
                session()->flash('warning', 'You can not delete ' . $subcategory->subcategory_name . '! It has ' . $product_counter . ' products.');
                return redirect()->back();
            }
        } else {
            $subcategory->delete();

            session()->flash('success', 'Product Subcategory deleted successfully!');
            return redirect()->back();
        }
    }
}
