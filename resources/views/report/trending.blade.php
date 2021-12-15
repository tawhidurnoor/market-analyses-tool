@extends('layouts.full.mainlayout')

@section('head')
<title>Trending Right Now | Market Analysese Tool</title>
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

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="normal-table-list mg-t-30">
                    <h2 class="text-info" style="font-size: 21px;">Popular Products</h2>
                    <p>Most sold products of last <strong>30</strong> days.</p>
                    <div class="bsc-tbl-st">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Subcategory</th>
                                    <th>Category</th>
                                    <th>Sold Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popular_products as $p_p)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$p_p->product_name}} </td>
                                    <td> {{$p_p->subcategory_name}} </td>
                                    <td> {{$p_p->category_name}} </td>
                                    <td> {{$p_p->sale_ammount}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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