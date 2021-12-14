@extends('layouts.full.mainlayout')

@section('head')
<title>Market Analysis Report | Market Analysese Tool</title>
@endsection

@section('body')

<!-- Start Status area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter"> {{$most_sold_product->sale_ammount}}</span> Units</h2>
                        <h3 class="text-success">{{$most_sold_product->product_name}}</h3>
                        <p>Most Sold Product This Week</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="height: 150px;">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter"> {{$most_sold_subcategory->sale_ammount}}</span> Units</h2>
                        <h3 class="text-primary">{{$most_sold_subcategory->subcategory_name}}</h3>
                        <p>Most Sold Product Subcategory This Week</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="height: 150px;">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter"> {{$most_sold_category->sale_ammount}}</span> Units</h2>
                        <h3 class="text-danger">{{$most_sold_category->category_name}}</h3>
                        <p>Most Sold Product Category This Week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Status area-->

@endsection

@section('scripts')
@endsection