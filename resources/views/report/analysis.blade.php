@extends('layouts.full.mainlayout')

@section('head')
<title>Analysis | Market Analysese Tool</title>
<!-- bootstrap select CSS
		============================================ -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-select/bootstrap-select.css')}}">
@section('body')

<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Market Analysis </h2>
                                    <p>Get <span class="bread-ntd">Analysed Data</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="modal" data-target="#add_modal" data-placement="left" title="Add A Subcategory" class="btn">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->

<div class="notika-status-area">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="cmp-tb-hd bcs-hd">
                        <h2>Select Your options</h2>
                        <p>Report are prepared based on location, category, subcategory and specific procuct. <span class="text-danger"> Left the option unselected which you don't want to include.</span></p>
                    </div>
                    <form action="" method="post" id="reportForm">
                        @csrf
                        <div class="row">

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Division</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="div_id" class="select_picker" data-live-search="true">
                                            <option value="">Select Division</option>
                                            @foreach($divisions as $div)
                                            <option value="{{$div->id}}">{{$div->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Districts</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="dis_id" class="select_picker" data-live-search="true">
                                            <option value="">Select District</option>
                                            @foreach($districts as $dis)
                                            <option value="{{$dis->id}}">{{$dis->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Cities</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="city_id" class="select_picker" data-live-search="true">
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Category</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="product_cat_id" class="select_picker" data-live-search="true">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Subcategory</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="product_subcat_id" class="select_picker" data-live-search="true">
                                            <option value="">Select Subcategory</option>
                                            @foreach($subcategories as $sub_cat)
                                            <option value="{{$sub_cat->id}}">{{$sub_cat->subcategory_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <label>Product</label>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select name="product_id" class="select_picker" data-live-search="true">
                                            <option value="">Select Product</option>
                                            @foreach($products as $prod)
                                            <option value="{{$prod->id}}">{{$prod->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        <center>
                            <button type="submit" class="btn">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> Generate
                            </button>
                        </center>
                    </form>

                    <div id="report">
                        <!-- Reports Returns here afer form submission -->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<!-- Data Table area End-->


@endsection

@section('scripts')
<!-- bootstrap select JS
		============================================ -->
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>
<script>
    $('.select_picker').selectpicker();
</script>

<script>
    // this is the id of the form
    $("#reportForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.


        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "../../report/analysis",
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                //alert(data); // show response from the php script.
                $('#report').html(data);
            }
        });


    });
</script>
@endsection