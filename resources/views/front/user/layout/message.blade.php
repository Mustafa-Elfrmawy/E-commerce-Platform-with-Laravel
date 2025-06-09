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

@if (Session::has('successRegister'))
    <div class="alert alert-success alert-dismissible fade show shadow rounded px-4 py-3 mb-4 border border-success position-relative">
        <button type="button" class="close position-absolute top-0 end-0 m-2" data-dismiss="alert" aria-label="Close" style="font-size: 1.5rem;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-flex align-items-center">
            <span class="me-2" style="font-size: 2rem; color: #28a745;">
                <i class="fa fa-check-circle"></i>
            </span>
            <div>
                <h5 class="mb-1 fw-bold text-success">Registration Successful Sign In Now!</h5>
                <div class="text-dark">
                    {{ Session::get('successRegister') }}
                </div>
            </div>
        </div>
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
