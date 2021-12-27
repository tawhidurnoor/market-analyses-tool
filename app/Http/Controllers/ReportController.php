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
        //$date = Carbon::now()->subDays(7);

        /*
        $most_sold_product = Sale::where('sales.created_at', '>=', $date)
            ->join('products', 'sales.product_id', 'products.id')
            ->selectRaw('sum(sale_ammount) as sale_ammount, products.product_name as product_name')
            ->groupBy('product_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();
            */

        $most_sold_product = [];
        $i = 7;
        //looping till we get a non null value, date is updated through this wile loop for all entries
        while (!$most_sold_product) {
            $date = Carbon::now()->subDays($i);

            $most_sold_product = Sale::where('sales.created_at', '>=', $date)
                ->join('products', 'sales.product_id', 'products.id')
                ->selectRaw('sum(sale_ammount) as sale_ammount, products.product_name as product_name')
                ->groupBy('product_name')
                ->orderBy('sale_ammount', 'desc')
                ->first();
            $i++;
        }

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

        $popular_products = [];
        $i = 30;
        while (!$popular_products) {

            $date = Carbon::now()->subDays($i);
            $popular_products = Sale::where('sales.created_at', '>=', $date)
                ->join('products', 'sales.product_id', 'products.id')
                ->join('product_subcategories', 'products.product_subcat_id', 'product_subcategories.id')
                ->join('product_categories', 'product_subcategories.category_id', 'product_categories.id')
                ->select('products.product_name as product_name', DB::raw('SUM(sale_ammount) as sale_ammount'), 'product_subcategories.subcategory_name as subcategory_name', 'product_categories.category_name as category_name')
                ->groupByRaw('product_name, category_name, subcategory_name')
                ->orderBy('sale_ammount', 'desc')
                ->take(10)
                ->get();
            $i++;
        }

        return view('report.trending', compact('most_sold_product', 'most_sold_subcategory', 'most_sold_category', 'popular_products'));
    }

    public function analysisIndex()
    {
        $returns =  Sale::where('product_id', 1)
            ->select(DB::raw("(sum(sale_ammount)) as sale_ammount"))
            ->whereBetween(
                'date',
                [Carbon::now()->subMonth(6), Carbon::now()]
            )
            ->groupBy(DB::raw("DATE_FORMAT(date, '%m-%Y')"))
            ->get();
        //return $returns;

        $districts = District::all();
        $divisions = Division::all();
        $cities = City::all();
        $categories = ProductCategory::all();
        $subcategories  = ProductSubcategory::all();
        $products = Product::all();
        return view('report.analysis', compact('districts', 'divisions', 'cities', 'categories', 'subcategories', 'products'));
    }

    public function analysisResult(Request $request)
    {

        if (!$request->div_id && !$request->dis_id && !$request->city_id && !$request->product_cat_id && !$request->product_subcat_id && !$request->product_id) {
            return 'faka';
        } else {
            if ($request->div_id || $request->dis_id || $request->city_id) {
                //location selected
                return "Location selected";
            } else {
                //location not selected
                //now I have to checke wihch one form product is selected
                if ($request->product_id) {
                    //Only Product is selected

                    $html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bar-chart-wp">
                                    <canvas height="100vh" id="barchart"></canvas>
                                </div>
                            </div>';
                    $six_month_sales_report = Sale::where('product_id', $request->product_id)
                        ->select(DB::raw("(sum(sale_ammount)) as sale_ammount"))
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->groupBy(DB::raw("DATE_FORMAT(date, '%m-%Y')"))
                        ->get();

                    $data = [5, 3, 6, 7, 3, 9];
                    return [
                        'html' => $html,
                        'data' => $six_month_sales_report,
                    ];
                } elseif ($request->product_subcat_id) {
                    return 'Product not selected but subcat selected';
                } else {
                    return 'Product and Subcat not selected but cat is selected';
                }
                return "Location not selected";
            }
        }
        //return $request->div_id . " " . $request->dis_id . " " . $request->city_id . " " . $request->product_cat_id . " " . $request->product_subcat_id;

    }
}
