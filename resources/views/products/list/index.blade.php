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
                                    <i class="fa fa-cube" aria-hidden="true"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>List of all Products </h2>
                                    <p>Manage all <span class="bread-ntd">Products</span></p>
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
                                    <th>Product Name</th>
                                    <th>Product Subcategory</th>
                                    <th>MRP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$product->product_name}} </td>
                                    <td> {{$product->subcategory_name}} </td>
                                    <td> {{$product->mrp}} </td>
                                    <td>
                                        <div class="btn-list">
                                            <button class="btn btn-info notika-btn-info waves-effect edit-button" data-id="{{$product->id}}">
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            </button>
                                            <button class="btn btn-danger notika-btn-danger waves-effect delete-button" data-id="{{$product->id}}">
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
                                    <th>Product Name</th>
                                    <th>Product Subcategory</th>
                                    <th>MRP</th>
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
            <form action="{{route('product.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h2>Add a Product</h2>
                    <div class="form-group">
                        <div class="nk-int-st">
                            <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label>Category</label> -->
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="product_subcat_id" class="sub_categories" data-live-search="true" required>
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $sub_cat)
                                <option value="{{$sub_cat->id}}">{{$sub_cat->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="nk-int-st">
                            <input type="number" step="any" name="mrp" class="form-control" placeholder="MRP" required>
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
                    <h2>Edit Product Subcategory</h2>

                    <div class="form-group">
                        <div class="nk-int-st">
                            <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="Subcategory Name" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <!-- <label>Category</label> -->
                        <div class="bootstrap-select fm-cmp-mg">
                            <select name="category_id" class="categories" data-live-search="true">
                                @foreach($subcategories as $sub_cat)
                                <option value="{{$sub_cat->id}}">{{$sub_cat->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>

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
    $('.sub_categories').selectpicker();

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
            console.log(id);
            document.getElementById("delete_form").action = "../../../products/subcategory/" + id;
        });
    });

    function getEditDetails(id) {
        $.ajax({
            type: 'GET',
            url: '../../../products/subcategory/' + id,
            dataType: 'json',
            success: function(response) {
                $('#subcategory_name').val(response.subcategory_name);
                $('.categories').selectpicker('val', response.category_id);
            }
        });

        document.getElementById("edit_form").action = "../../../products/subcategory/" + id;
    }
</script>

@endsection