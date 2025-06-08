@if (Session::has('message'))
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-check"></i>Alert!</h4>
        {{ Session::get('message') }}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-check"></i>Success</h4>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('errorFindProduct'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-check"></i>Error</h4>
        {{ Session::get('errorFindProduct') }}
    </div>
@endif


