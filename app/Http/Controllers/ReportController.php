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
        $return = Sale::where('product_id', 2)
            ->join('cities', 'sales.city_id', 'cities.id')
            ->selectRaw('sum(sales.sale_ammount) as sale_ammount, cities.city_name as city_name')
            ->groupBy('cities.city_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();
        //return $return;

        $districts = District::all();
        $divisions = Division::all();
        $cities = City::all();
        $categories = ProductCategory::all();
        $subcategories  = ProductSubcategory::all();
        $products = Product::all();
        return view('report.analysis', compact('districts', 'divisions', 'cities', 'categories', 'subcategories', 'products'));
    }

    public function test()
    {
        $products = Product::where('product_subcat_id', 3)
            ->select('id')
            ->get();
        $product_ids = [];
        foreach ($products as $p) {
            array_push($product_ids, $p->id);
        }

        $most_sold_product = Sale::whereIn('product_id', $product_ids)
            ->join('products', 'sales.product_id', 'products.id')
            ->selectRaw('sum(sales.sale_ammount) as sale_ammount, products.product_name as product_name')
            ->whereBetween(
                'date',
                [Carbon::now()->subMonth(6), Carbon::now()]
            )
            ->groupBy('product_name')
            ->orderBy('sale_ammount', 'desc')
            ->first();

        return $most_sold_product;
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
                if ($request->product_id) { //Only Product is selected

                    $most_sold_city = Sale::where('product_id', $request->product_id)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, cities.city_name as city_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->groupBy('cities.city_name')
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $most_sold_district = Sale::where('product_id', $request->product_id)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->groupBy('districts.district_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, districts.district_name as district_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $most_sold_division = Sale::where('product_id', $request->product_id)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->join('divisions', 'districts.division_id', 'divisions.id')
                        ->groupBy('divisions.division_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, divisions.division_name as division_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $html = '<h3>Sales Statistics</h3>
                     <p>Sales Statistics of last 6 months(if available)</p>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_city->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-success">' . $most_sold_city->city_name . '</h3>
                                    <p>Most Sold in ihis City</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_district->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-primary">' . $most_sold_district->district_name . '</h3>
                                    <p>Most Sold in ihis District</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_division->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-danger">' . $most_sold_division->division_name . '</h3>
                                    <p>Most Sold in ihis Division</p>
                                </div>
                            </div>
                        </div>
                    </div>';

                    $html .= '<br><br>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="bar-chart-wp">
                                        <canvas height="100vh" id="barchart"></canvas>
                                    </div>
                                </div>
                            </div>';

                    $six_month_sales_report = Sale::where('product_id', $request->product_id)
                        ->select(DB::raw("(sum(sale_ammount)) as sale_ammount"), DB::raw("DATE_FORMAT(date, '%M-%Y') as month"))
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->groupBy(DB::raw("DATE_FORMAT(date, '%M-%Y')"))
                        ->get();

                    return [
                        'html' => $html,
                        'data' => $six_month_sales_report,
                    ];
                } elseif ($request->product_subcat_id) { //Product not selected but subcat selected

                    $products = Product::where('product_subcat_id', $request->product_subcat_id)
                        ->select('id')
                        ->get();
                    $product_ids = [];
                    foreach ($products as $p) {
                        array_push($product_ids, $p->id);
                    }

                    $most_sold_product = Sale::whereIn('product_id', $product_ids)
                        ->join('products', 'sales.product_id', 'products.id')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, products.product_name as product_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->groupBy('product_name')
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    // $most_sold_city = Sale::where('product_id', $request->product_id)
                    //     ->join('cities', 'sales.city_id', 'cities.id')
                    //     ->selectRaw('sum(sales.sale_ammount) as sale_ammount, cities.city_name as city_name')
                    //     ->whereBetween(
                    //         'date',
                    //         [Carbon::now()->subMonth(6), Carbon::now()]
                    //     )
                    //     ->groupBy('cities.city_name')
                    //     ->orderBy('sale_ammount', 'desc')
                    //     ->first();

                    $most_sold_district = Sale::whereIn('product_id', $product_ids)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->groupBy('districts.district_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, districts.district_name as district_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $most_sold_division = Sale::whereIn('product_id', $product_ids)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->join('divisions', 'districts.division_id', 'divisions.id')
                        ->groupBy('divisions.division_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, divisions.division_name as division_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $html = '<h3>Sales Statistics</h3>
                     <p>Sales Statistics of last 6 months(if available)</p>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_product->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-success">' . $most_sold_product->product_name . '</h3>
                                    <p>Most Sold in ihis Subcategory</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_district->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-primary">' . $most_sold_district->district_name . '</h3>
                                    <p>Most Sold in ihis District</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_division->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-danger">' . $most_sold_division->division_name . '</h3>
                                    <p>Most Sold in ihis Division</p>
                                </div>
                            </div>
                        </div>
                    </div>';

                    // $html .= '<br><br>
                    //         <div class="row">
                    //             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    //                 <div class="bar-chart-wp">
                    //                     <canvas height="100vh" id="barchart"></canvas>
                    //                 </div>
                    //             </div>
                    //         </div>';

                    // $six_month_sales_report = Sale::where('product_id', $request->product_id)
                    //     ->select(DB::raw("(sum(sale_ammount)) as sale_ammount"), DB::raw("DATE_FORMAT(date, '%M-%Y') as month"))
                    //     ->whereBetween(
                    //         'date',
                    //         [Carbon::now()->subMonth(6), Carbon::now()]
                    //     )
                    //     ->groupBy(DB::raw("DATE_FORMAT(date, '%M-%Y')"))
                    //     ->get();

                    return [
                        'html' => $html,
                        'data' => null,
                    ];
                } else {
                    //Product and Subcat not selected but cat is selected
                    //product_cat_id
                    $subcat = ProductSubcategory::where('category_id', $request->product_cat_id)
                        ->select('id')
                        ->get();
                    $subcat_ids = [];
                    foreach ($subcat as $s) {
                        array_push($subcat_ids, $s->id);
                    }

                    $products = Product::whereIn('product_subcat_id', $subcat_ids)
                        ->select('id')
                        ->get();

                    $product_ids = [];

                    foreach ($products as $p) {
                        array_push($product_ids, $p->id);
                    }

                    $most_sold_product = Sale::whereIn('product_id', $product_ids)
                        ->join('products', 'sales.product_id', 'products.id')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, products.product_name as product_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->groupBy('product_name')
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $most_sold_district = Sale::whereIn('product_id', $product_ids)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->groupBy('districts.district_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, districts.district_name as district_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();

                    $most_sold_division = Sale::whereIn('product_id', $product_ids)
                        ->join('cities', 'sales.city_id', 'cities.id')
                        ->join('districts', 'cities.district_id', 'districts.id')
                        ->join('divisions', 'districts.division_id', 'divisions.id')
                        ->groupBy('divisions.division_name')
                        ->selectRaw('sum(sales.sale_ammount) as sale_ammount, divisions.division_name as division_name')
                        ->whereBetween(
                            'date',
                            [Carbon::now()->subMonth(6), Carbon::now()]
                        )
                        ->orderBy('sale_ammount', 'desc')
                        ->first();



                    $html = '<h3>Sales Statistics</h3>
                     <p>Sales Statistics of last 6 months(if available)</p>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_product->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-success">' . $most_sold_product->product_name . '</h3>
                                    <p>Most Sold in ihis Subcategory</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_district->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-primary">' . $most_sold_district->district_name . '</h3>
                                    <p>Most Sold in ihis District</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="height: 150px;">
                                <div class="website-traffic-ctn">
                                    <h2><span class="counter">' . $most_sold_division->sale_ammount . '</span> Units</h2>
                                    <h3 class="text-danger">' . $most_sold_division->division_name . '</h3>
                                    <p>Most Sold in ihis Division</p>
                                </div>
                            </div>
                        </div>
                    </div>';

                    return [
                        'html' => $html,
                        'data' => [],
                    ];
                }

                //return "Location not selected";
            }
        }
        //return $request->div_id . " " . $request->dis_id . " " . $request->city_id . " " . $request->product_cat_id . " " . $request->product_subcat_id;

    }
}
