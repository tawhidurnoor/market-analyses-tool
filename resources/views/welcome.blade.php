@extends('layouts.full.mainlayout')

@section('head')
<title>Dashboard One | Notika - Notika Admin Template</title>
@endsection

@section('body')

<!-- Start Status area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1>Market Analysis Tool</h1>
                <p>
                    Analysis market data within minutes! For Free!.
                </p>
                <br>
                <a class="btn btn-success" href="/login">Login</a>
                <a class="btn btn-info" href="/register">Signup</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="{{asset('assets/images/mat_banner.svg')}}" alt="" srcset="">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection