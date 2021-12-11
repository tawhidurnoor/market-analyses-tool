@extends('layouts.full.mainlayout')

@section('head')
<title>Create User Role | Market Analysese Tool</title>
<style>
    .capitalize {
        text-transform: capitalize;
    }
</style>
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
                                <!-- <a href="{{route('roles.create')}}">
                                    <button data-toggle="tooltip" data-placement="left" title="Add A Role" class="btn"><i class="notika-icon notika-checked"></i></button>
                                </a> -->
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

                        <br>

                        <div class="form-group">
                            <label for="permissions">Permissions</label>

                            <div id="permissions" class="capitalize">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkPermissionAll">
                                    <label class="form-check-label" for="checkPermissionAll">
                                        Check All
                                    </label>
                                </div>

                                <hr>

                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{$i}}Management" value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)">
                                            <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 role-{{ $i }}-management-checkbox">
                                        @php
                                        $permissions = App\User::getpermissionsByGroupName($group->name);
                                        $j = 1;
                                        @endphp
                                        @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->name}}" id="checkPermission{{$permission->id}}" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', '{{ count($permissions) }}' )">
                                            <label class="form-check-label" for="checkPermission{{$permission->id}}">{{ $permission->name }}</label>
                                        </div>
                                        @php $j++; @endphp
                                        @endforeach
                                        <br>
                                    </div>

                                </div>
                                @php $i++; @endphp
                                @endforeach

                            </div>


                        </div>

                        <div class="form-group">
                            <div class="nk-int-st">
                                <button type="submit" class="btn btn-success notika-btn-success waves-effect">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i> Add
                                </button>
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
@include('roles.partials.script')
@endsection