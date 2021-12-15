<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Division;
use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function trending()
    {
        $date = Carbon::now()->subDays(7);

        $most_sold_product = Sale::where('sales.created_at', '>=', $date)
            ->join('products', 'sales.product_id', 'products.id')
            ->selectRaw('sum(sale_ammount) as sale_ammount, products.product_name as product_name')
            ->groupBy('product_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();
        $most_sold_subcategory = Sale::where('sales.created_at', '>=', $date)
            ->join('products', 'sales.product_id', 'products.id')
            ->join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
            ->selectRaw('sum(sale_ammount) as sale_ammount, product_subcategories.subcategory_name as subcategory_name')
            ->groupBy('subcategory_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();
        $most_sold_category = Sale::where('sales.created_at', '>=', $date)
            ->join('products', 'sales.product_id', 'products.id')
            ->join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
            ->join('product_categories', 'product_subcategories.category_id', 'product_categories.id')
            ->selectRaw('sum(sale_ammount) as sale_ammount, product_categories.category_name as category_name')
            ->groupBy('category_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();

        $popular_products = Sale::where('sales.created_at', '>=', $date)
            ->join('products', 'sales.product_id', 'products.id')
            ->join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
            ->join('product_categories', 'product_subcategories.category_id', 'product_categories.id')
            ->select('products.product_name as product_name', DB::raw('SUM(sale_ammount) as sale_ammount'), 'product_subcategories.subcategory_name as subcategory_name', 'product_categories.category_name as category_name')
            ->groupByRaw('product_name, category_name, subcategory_name')
            ->orderBy('sale_ammount', 'desc')
            ->take(10)
            ->get();

        return view('report.trending', compact('most_sold_product', 'most_sold_subcategory', 'most_sold_category', 'popular_products'));
    }

    public function analysisIndex()
    {
        $districts = District::all();
        $divisions = Division::all();
        $cities = City::all();
        $categories = ProductCategory::all();
        $subcategories  = ProductSubcategory::all();
        $products = Product::all();
        return view('report.analysis', compact('districts', 'divisions', 'cities', 'categories', 'subcategories', 'products'));
    }
}
