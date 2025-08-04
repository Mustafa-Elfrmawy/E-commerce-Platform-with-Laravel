    @if (Session::has('successOrder'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
            {{ Session::get('successOrder') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
            {{ session('errorOrder') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errorProductNotFound'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
            {{ session('errorProductNotFound') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif