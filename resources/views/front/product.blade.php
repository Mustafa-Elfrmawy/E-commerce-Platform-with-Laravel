@php
    use function App\Url\my_asset;
@endphp

{{-- @dd(Auth::guard('user')->user()) --}}
@if (Auth::guard('user')->check() )
    <p>المستخدم مسجل دخول: {{ Auth::guard('user')->user()->name }}</p>
@else
    <p>المستخدم غير مسجل دخول</p>
@endif

@extends('front.layout.app')
@section('Home')
    product
@endsection
@section('content')
    <div>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit">logout</button>
        </form>
    </div>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop' , [2 , $product->sub_category_id] ) }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">

                <div class="col-md-5">


                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            @if ($images->isNotEmpty())
                                @foreach ($images as $index => $filename)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ my_asset('storage/' . $filename->image_product) }}"
                                            class="d-block w-100" alt="Image {{ $index + 1 }}"
                                            style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            @else
                            @endif
                        </div>

                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>


                </div>

                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{ $product->title }} </h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        @if ($product->compare_price > 0)
                            <h2 class="price text-secondary"><del>{{ $product->compare_price }}</del></h2>
                        @endif
                        <h2 class="price ">{{ $product->price }} </h2>

                        {{-- <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis officiis dolor
                             aut nihil iste porro ullam repellendus
                              inventore voluptatem nam
                               veritatis exercitationem doloribus
                                voluptates dolorem nobis voluptatum qui, minus facere.</p> --}}
                        <a href="javascript:void(0);"
                            onclick="addToCart({{ $product->id }}, '{{ addslashes($product->title) }}')"
                            class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART</a>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="true">Description</button>
                            </li>

                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                            </li> --}}
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p>
                                <p>{!! $product->description !!}</p>

                                </p>
                            </div>
                            {{-- <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 section-8">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="col-md-12">

                <div id="related-products" class="carousel">
                    @if ($products_related->isNotEmpty())
                        @foreach ($products_related as $product_related)
                            <div class="card product-card" style="width: 180px; margin: 0 8px;">
                                <div class="product-image position-relative" style="height: 160px; overflow: hidden;">
                                    @if (!empty($product->image_id))
                                        @php
                                            $images = collect();
                                            if (!empty($product_related->image_id)) {
                                                $images = App\Models\ProductImage::whereIn(
                                                    'id',
                                                    explode(',', $product_related->image_id),
                                                )
                                                    ->latest()
                                                    ->pluck('image_product');
                                            }
                                        @endphp
                                        @if ($images && $images->first() != null)
                                            <a href="" class="product-img">
                                                <img class="card-img-top"
                                                    src="{{ my_asset('storage/' . $images->first()) }}" alt=""
                                                    style="height: 100%; width: 100%; object-fit: cover;">
                                            </a>
                                        @endif
                                    @endif

                                    <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                    <div class="product-action" style="bottom: 10px; right: 10px;">
                                        <a class="btn btn-dark btn-sm" href="#">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-2 p-2" style="font-size: 0.95rem;">
                                    <a class="h6 link" href=""
                                        style="font-size: 1rem;">{{ $product_related->title }}</a>
                                    <div class="price mt-1">
                                        @if ($product_related->compare_price > 0)
                                            <span
                                                class="h6"><strong>${{ $product_related->compare_price }}</strong></span>
                                        @endif
                                        <span class="h6 text-underline"><del> {{ $product_related->price }} </del></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-js')
    <script type="text/javascript">
       
    </script>
@endsection
