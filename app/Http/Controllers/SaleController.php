<?php

namespace App\Http\Controllers;

use App\City;
use App\Product;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::join('products', 'sales.product_id', 'products.id')
            ->join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
            ->join('cities', 'sales.city_id', 'cities.id')
            ->selectRaw('sales.*, product_subcategories.subcategory_name, products.product_name, cities.city_name')
            ->get();
        $products = Product::selectRaw('id, product_name')->get();
        $cities = City::selectRaw('id, city_name')->get();

        return view('sale.index', compact('sales', 'products', 'cities'));
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
        $sale = new Sale();
        $sale->date = Carbon::now()->format('Y-m-d');
        $sale->product_id = $request->product_id;
        $sale->city_id = $request->city_id;
        $sale->sale_ammount = $request->sale_ammount;

        $sale->save();

        session()->flash('success', 'Sale stored successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return $sale;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->product_id = $request->product_id;
        $sale->city_id = $request->city_id;
        $sale->sale_ammount = $request->sale_ammount;

        $sale->save();

        session()->flash('success', 'Sale updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
