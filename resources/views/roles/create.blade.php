@extends('layouts.full.mainlayout')

@section('head')
<title>Create User Role | Market Analysese Tool</title>
@endsection

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
                                    <i class="notika-icon notika-form"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Add User Role</h2>
                                    <p>Add a new <span class="bread-ntd">User Role</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <a href="{{route('roles.create')}}">
                                    <button data-toggle="tooltip" data-placement="left" title="Add A Role" class="btn"><i class="notika-icon notika-checked"></i></button>
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
                <div class="form-element-list">
                    <!--
                        <div class="basic-tb-hd">
                        <h2>Basic Example</h2>
                        <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p>
                    </div>
                    -->
                    @include('layouts.partials.messages')
                    <br>
                    <form action="{{route('roles.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <div class="nk-int-st">
                                <input type="text" class="form-control" name="name" placeholder="Role Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            @foreach($permissions as $permission)
                            <div class="form-check">
                                <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->name}}" id="chcekPermission{{$permission->id}}">
                                <label class="form-check-label" for="chcekPermission{{$permission->id}}">
                                    {{$permission->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <div class="nk-int-st">
                                <button type="submit" class="btn btn-success notika-btn-success waves-effect">Add</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data Table area End-->

@endsection

@section('scripts')
@endsection