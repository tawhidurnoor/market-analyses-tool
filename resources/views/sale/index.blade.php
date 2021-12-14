@extends('layouts.full.mainlayout')

@section('head')
<title>Product List | Market Analysese Tool</title>

<!-- bootstrap select CSS
		============================================ -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-select/bootstrap-select.css')}}">
@endsection

<!-- Data Table CSS
============================================ -->
<link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
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
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Sale Manager</h2>
                                    <p>Manage all <span class="bread-ntd">Sales</span></p>
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
<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!--
                        <div class="basic-tb-hd">
                        <h2>Basic Example</h2>
                        <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p>
                    </div>
                    -->

                    @include('layouts.partials.messages')
                    <br>

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>City</th>
                                    <th>Product Subcategory</th>
                                    <th>Sale Ammount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$sale->date}} </td>
                                    <td> {{$sale->product_name}} </td>
                                    <td> {{$sale->city_name}} </td>
                                    <td> {{$sale->subcategory_name}} </td>
                                    <td> {{$sale->sale_ammount}} </td>
                                    <td>
                                        <div class="btn-list">
                                            <button class="btn btn-info notika-btn-info waves-effect edit-button" data-id="{{$sale->id}}">
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            </button>
                                            <button class="btn btn-danger notika-btn-danger waves-effect delete-button" data-id="{{$sale->id}}">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>City</th>
                                    <th>Product Subcategory</th>
                                    <th>Sale Ammount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Data Table area End-->

<!-- Add Modal -->
<div class="modal fade" id="add_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('sale.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h2>Add Sale</h2>

                    <div class="form-group">
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="product_id" class="products" data-live-search="true" required>
                                <option value="">Select Product</option>
                                @foreach($products as $prods)
                                <option value="{{$prods->id}}">{{$prods->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="city_id" class="cities" data-live-search="true" required>
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="nk-int-st">
                            <input type="number" step="any" name="sale_ammount" class="form-control" placeholder="Sale Ammount" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" id="edit_form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <h2>Edit Sale</h2>

                    <div class="form-group">
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="product_id" class="products" data-live-search="true" required>
                                <option value="">Select Product</option>
                                @foreach($products as $prods)
                                <option value="{{$prods->id}}">{{$prods->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="city_id" class="cities" data-live-search="true" required>
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="nk-int-st">
                            <input type="number" step="any" name="sale_ammount" class="form-control" placeholder="Sale Ammount" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" id="delete_form">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h2>Delete Entry?</h2>
                    <p>Are you sure to delete this entry? This Process can't be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Data Table JS
		============================================ -->
<script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/data-table/data-table-act.js')}}"></script>

<!-- bootstrap select JS
		============================================ -->
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>

<script>
    // To style only selects with the my-select class
    $('.products').selectpicker();
    $('.cities').selectpicker();

    $(function() {
        $(document).on('click', '.edit-button', function(e) {
            e.preventDefault();
            $('#edit_modal').modal('show');
            var id = $(this).data('id');
            getEditDetails(id)
        });

        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            $('#delete_modal').modal('show');
            var id = $(this).data('id');
            //$('#del_id').val(id);
            document.getElementById("delete_form").action = "../../../products/product/" + id;
        });
    });

    function getEditDetails(id) {
        $.ajax({
            type: 'GET',
            url: '../../../products/product/' + id,
            dataType: 'json',
            success: function(response) {
                $('#product_name').val(response.product_name);
                $('.sub_categories_edit').selectpicker('val', response.product_subcat_id);
                $('#mrp').val(response.mrp);
            }
        });

        document.getElementById("edit_form").action = "../../../products/product/" + id;
    }
</script>

@endsection