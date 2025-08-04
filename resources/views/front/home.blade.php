@php
    use function App\Url\my_asset;
@endphp
@extends('front.layout.app')
@section('Home')
    Shop
@endsection

@section('content')
    <style>
        .cat-card .left {
            width: 100%;
            height: 100px;
            overflow: hidden;
            position: relative;
        }

        .cat-card .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 8px;
        }

        .product-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card {
            height: 350px;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .product-card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }

        .activeYellow {
            color: yellow;
        }

        /* إظهار أيقونة القلب دايماً */
        .product-image .whishlist,
        .product-card .whishlist,
        a.whishlist {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
            position: absolute !important;
            top: 10px !important;
            right: 10px !important;
            z-index: 10 !important;
            background: rgba(255, 255, 255, 0.8) !important;
            border-radius: 50% !important;
            width: 35px !important;
            height: 35px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
        }

        .product-image:hover .whishlist,
        .product-card:hover .whishlist {
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
@include('front.layout.alertHome')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="asset('Front/images/carousel-1.jpg')" class="d-block w-100" alt=""> -->
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <source media="(min-width: 800px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <img src="{{ my_asset('Front/images/150x150.png') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet.
                                Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <source media="(min-width: 800px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <img src="{{ my_asset('Front/images/150x150.png') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet.
                                Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    {{-- <img src="{{ asset('Front/images/150x150.png') }}" class="d-block w-100" alt=""> --}}

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <source media="(min-width: 800px)" srcset="{{ my_asset('Front/images/150x150.png') }}" />
                        <img src="{{ my_asset('Front/images/150x150.png') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded
                                Clothes
                            </h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet.
                                Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="cat-card">
                                <div class="left">
                                    @if (!empty($category->image->name))
                                        <img src="{{ my_asset('storage/' . $category->image->name) }}"
                                            class="img-fluid w-100 h-100" alt="">
                                    @else
                                        <img src="{{ my_asset('Front/images/150x150.png') }}" class="img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="right">
                                    <a href="{{ route('front.shop', $category->id) }}">
                                        <div class="cat-data">
                                            <div class="cat-data w-50">
                                                <h2 style="color: black"> {{ $category->name }}</h2>
                                            </div>
                                            <p> {{ $category->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div class="row pb-3">




                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        {{-- @dd($wishList); --}}
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    @php
                                        $img = $product->image_id
                                            ? App\Models\ProductImage::latest()
                                                ->whereIn('id', explode(',', $product->image_id))
                                                ->first()
                                            : null;
                                    @endphp

                                    <a href="{{ route('front.product', $product->id) }}" class="product-img">
                                        <img class="card-img-top"
                                            src=" {{ my_asset($img ? 'storage/' . $img->image_product : 'Front/images/150x150.png') }}"
                                            alt="">
                                    </a>
                                    <a class="whishlist" onclick="wishList({{ $product->id }}); return false;"
                                        href="#"><i
                                            class="far fa-heart 
                                        {{ in_array($product->id, $wishList) ? 'fas activeYellow' : '' }}"></i></a>
                                    <div class="product-action">
                                        <a class="btn btn-dark" href="javascript:void(0);"
                                            onclick="addToCart({{ $product->id }}, '{{ addslashes($product->title) }}')">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        @if ($product->compare_price > 0)
                                            <span class="h5"><strong>{{ $product->compare_price }}</strong></span>
                                        @endif
                                        <span class="h6 text-underline"><del>{{ $product->price }}</del></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif




            </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Produsts</h2>
            </div>
            <div class="row pb-3">

                @if ($products_latest->isNotEmpty())
                    @foreach ($products_latest as $product_latest)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    @php
                                        $images_latest = $product_latest->image_id
                                            ? App\Models\ProductImage::latest()
                                                ->whereIn('id', explode(',', $product_latest->image_id))
                                                ->get()
                                            : collect();
                                    @endphp

                                    @php
                                        $img = $images_latest->first();
                                    @endphp

                                    <a href="{{ route('front.product', $product_latest->id) }}" class="product-img">
                                        <img class="card-img-top"
                                            src="{{ my_asset($img ? 'storage/' . $img->image_product : 'Front/images/150x150.png') }}"
                                            alt="">
                                    </a>

                                    <a class="whishlist" onclick="wishList({{ $product_latest->id }}); return false;" href="#"><i
                                            class="far fa-heart
                                            {{ in_array($product_latest->id, $wishList) ? 'fas activeYellow' : '' }}"></i></a>

                                    <div class="product-action">
                                        <a class="btn btn-dark" href="javascript:void(0);"
                                            onclick="addToCart({{ $product_latest->id }}, '{{ addslashes($product_latest->title) }}')">
                                            <i
                                                class="fa fa-shopping-cart"></i>
                                            Add To Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="product.php">{{ $product_latest->title }}</a>
                                    <div class="price mt-2">
                                        @if ($product_latest->compare_price > 0)
                                            <span
                                                class="h5"><strong>{{ $product_latest->compare_price }}</strong></span>
                                        @endif
                                        <span class="h6 text-underline"><del>{{ $product_latest->price }}</del></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
@endsection
