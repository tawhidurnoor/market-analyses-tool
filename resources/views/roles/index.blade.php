@extends('layouts.full.mainlayout')

@section('head')
<title>User Roles | Market Analysese Tool</title>
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
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>User Roles</h2>
                                    <p>Manage all <span class="bread-ntd">User Role</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <a href="{{route('roles.create')}}">
                                    <button data-toggle="tooltip" data-placement="left" title="Add A Role" class="btn">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Add
                                    </button>
                                </a>
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
                                    <th>Role Name</th>
                                    <th width="700px">Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$role->name}} </td>
                                    <td>
                                        @foreach ($role->permissions as $perm)
                                        <span class="badge badge-info mr-1">
                                            {{ $perm->name }}
                                        </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-list">

                                            @if(Auth::user()->can('role.edit'))
                                            <a href="{{route('roles.edit', $role->id)}}" class="btn btn-info notika-btn-info waves-effect">
                                                <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                            </a>
                                            @endif
                                            <button class="btn btn-danger notika-btn-danger waves-effect delete-button" data-id="{{$role->id}}">
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
                                    <th>Role Name</th>
                                    <th>Permissions</th>
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
<script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('assets/js/data-table/data-table-act.js')}}"></script>

<script>
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        $('#delete_modal').modal('show');
        var id = $(this).data('id');
        //$('#del_id').val(id);
        document.getElementById("delete_form").action = "roles/" + id;
    });
</script>

@endsection