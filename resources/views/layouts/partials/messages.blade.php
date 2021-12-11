@if ($errors->any())
<div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
            <i class="notika-icon notika-close"></i>
        </span>
    </button>
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
            <i class="notika-icon notika-close"></i>
        </span>
    </button>
    <p>
        {{Session::get('success')}}
    </p>
</div>
@endif