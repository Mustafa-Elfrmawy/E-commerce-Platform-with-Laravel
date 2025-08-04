    @php
        use function App\Url\my_asset;
    @endphp
    @extends('front.layout.app')
    @section('Home')
        Shop
    @endsection

    @section('content')
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('front.user.layout.message')
                        @include('front.user.layout.account-panel')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                            </div>
                            <div class="card-body p-4">
                                @if ($wishLists->isNotEmpty())
                                    @foreach ($wishLists as $wishList)
                                        @php
                                            $img = collect();
                                            $img = \App\Models\ProductImage::whereIn(
                                                'id',
                                                explode(',', $wishList->product->image_id),
                                            )->first();
                                        @endphp
                                        <div
                                            class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                            <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a
                                                    class="d-block flex-shrink-0 mx-auto me-sm-4" href="#"
                                                    style="width: 10rem;"><img
                                                        src="{{ my_asset($img ? 'storage/' . $img->image_product : 'Front/images/150x150.png') }}"
                                                        alt="Product"></a>
                                                <div class="pt-2">
                                                    <h3 class="product-title fs-base mb-2"><a href="{{ route('front.product', $wishList->product->id) }}">
                                                            {{ $wishList->product->title }}
                                                        </a></h3>
                                                    <div class="fs-lg text-accent pt-2">
                                                        ${{ number_format($wishList->product->price, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                                <button onclick="deleteWishList({{ $wishList->product_id }})"
                                                    class="btn btn-outline-danger btn-sm" type="button"><i
                                                        class="fas fa-trash-alt me-2"></i>Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Your don't have a wishLists</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @section('custom-js')
        <script>
            function deleteWishList(product_id) {
                $.ajax({
                    url: "{{ route('user.wishList.delete') }}",
                    type: "DELETE",
                    data: {
                        product_id: product_id,
                    },
                    success: function(response) {
                        if (response.status === true) {
                            // alert(response.message);
                            // Change heart icon to full color yellow
                            // $('a.whishlist[onclick*="wishList(' + product_id + ')"] i').removeClass('far').addClass(
                            //     'fas').css('color', 'yellow');
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Your Unauthenticated please sign in and try again.');
                    }
                });
            }
        </script>
    @endsection
