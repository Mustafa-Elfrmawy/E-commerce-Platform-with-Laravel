@php
    use function App\Url\my_asset;
@endphp
@extends('front.layout.app')
@section('Home')
    shop
@endsection

@section('content')
    <style>
        .product-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-6 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <div class="sub-title">
                            <h2>Categories</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionExample">
                                    {{-- @dd($sub_categories); --}}
                                    @if ($sub_categories->isNotEmpty())
                                        @foreach ($sub_categories as $key => $sub_category)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne-{{ $key }}"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        {{ $sub_category->name }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne-{{ $key }}"
                                                    class="accordion-collapse collapse" aria-labelledby="headingOne"
                                                    data-bs-parent="#accordionExample" style="">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @if ($categories->isNotEmpty())
                                                                <a href="{{ route('front.shop', ['category_id' => $categories->first()->id, 'sub_category_id' => $sub_category->id]) }}"
                                                                    class="nav-item nav-link">
                                                                    {{ $sub_category->name }}</a>
                                                                @foreach ($categories as $category)
                                                                    @if ($category->sub_category_id == $sub_category->id)
                                                                        <a href="{{ route('front.shop', $category->id) }}"
                                                                            class="nav-item nav-link">{{ $category->name }}</a>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <a href="#" class="nav-item nav-link">empty</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif




                                </div>
                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Brand</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                @if ($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input
                                                class="form-check-input
                                            brand-label"
                                                name="brand[]" type="checkbox" value="5/2/{{ $brand->id }}"
                                                id="brand-{{ $brand->id }}"
                                                @if (isset(explode('/', $_SERVER['REQUEST_URI'])[5]) && explode('/', $_SERVER['REQUEST_URI'])[5] == $brand->id) {{ 'checked' }} @endif>
                                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Price</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">


                                <div class="form-check mb-2">
                                    {{-- @dd(explode( "/" , $_SERVER['REQUEST_URI'])); --}}
                                    <input class="form-check-input  price-label" name="price" type="checkbox"
                                        value="1/1/987654321123456789/0/100" id="flexCheckDefault"
                                        @if (isset(explode('/', $_SERVER['REQUEST_URI'])[7]) && explode('/', $_SERVER['REQUEST_URI'])[7] == '100') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        $0-$100
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input  price-label" name="price" type="checkbox"
                                        value="1/1/987654321123456789/100/200" id="flexCheckDefault"
                                        @if (isset(explode('/', $_SERVER['REQUEST_URI'])[7]) && explode('/', $_SERVER['REQUEST_URI'])[7] == '200') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $100-$200
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input  price-label" name="price" type="checkbox"
                                        value="1/1/987654321123456789/200/500" id="flexCheckDefault"
                                        @if (isset(explode('/', $_SERVER['REQUEST_URI'])[7]) && explode('/', $_SERVER['REQUEST_URI'])[7] == '500') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $200-$500
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input  price-label" name="price" type="checkbox"
                                        value="1/1/987654321123456789/500/+" id="flexCheckDefault"
                                        @if (isset(explode('/', $_SERVER['REQUEST_URI'])[7]) && explode('/', $_SERVER['REQUEST_URI'])[7] == '+') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $500+
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                @if($sort == 'latest')
                                                    Latest
                                                @elseif($sort == 'price_high')
                                                    Price High
                                                @elseif($sort == 'price_low')
                                                    Price Low
                                                @else
                                                    Sorting
                                                @endif
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item {{ $sort == 'latest' ? 'active' : '' }}" 
                                                   href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">Latest</a>
                                                <a class="dropdown-item {{ $sort == 'price_high' ? 'active' : '' }}" 
                                                   href="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}">Price High</a>
                                                <a class="dropdown-item {{ $sort == 'price_low' ? 'active' : '' }}" 
                                                   href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}">Price Low</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    @php
                                        $images = collect();
                                        if (!empty($product->image_id)) {
                                            $images = App\Models\ProductImage::whereIn(
                                                'id',
                                                explode(',', $product->image_id),
                                            )
                                                ->latest()
                                                ->pluck('image_product');
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="card product-card">
                                            <div class="product-image position-relative">
                                                @if ($images && $images->first() != null)
                                                    <a href="{{ route('front.product', $product->id) }}"
                                                        class="product-img"><img class="card-img-top"
                                                            src="{{ my_asset('storage/' . $images->first()) }}"
                                                            alt=""></a>
                                                @else
                                                    <a href="{{ route('front.product', $product->id) }}"
                                                        class="product-img"><img class="card-img-top"
                                                            src="{{ my_asset('Front/images/150x150.png') }}"
                                                            alt="image"></a>
                                                @endif
                                                <a class="whishlist"
                                                    onclick="wishList({{ $product->id }}); return false;"
                                                    href="#"><i class="far fa-heart"></i></a>

                                                <div class="product-action">
                                                    <a onclick="addToCart({{ $product->id }}, '{{ addslashes($product->title) }}')"
                                                        class="btn btn-dark" href="#">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body text-center mt-3">
                                                <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                                <div class="price mt-2">
                                                    <span class="h5"><strong>${{ $product->price }}</strong></span>
                                                    @if (isset($product->compare_price) && $product->compare_price > 0)
                                                        <span
                                                            class="h6 text-underline"><del>{{ $product->compare_price }}</del></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @endif



                            <div class="col-md-12 pt-5">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@section('custom-js')
    <script>
        $(".brand-label").change(function() {
            var selectedBrands = [];
            $("input[name='brand[]']:checked").each(function() {
                selectedBrands.push($(this).val());
            });
            console.log(selectedBrands.toString());
            var url = '{{ url()->current() }}/';
            var cleanUrl = url.replace(/(\/shop)(\/.*)?$/, '$1');
            window.location.href = cleanUrl + '/' + selectedBrands.toString();

        });

        $(".price-label").change(function() {
            var selectedPrice;
            $("input[name='price']:checked").each(function() {
                selectedPrice = $(this).val();
            });
            console.log(selectedPrice);
            var urlPrice = '{{ url()->current() }}/';
            var cleanUrlPrice = urlPrice.replace(/(\/shop)(\/.*)?$/, '$1');
            window.location.href = cleanUrlPrice + '/' + selectedPrice;
        });
    </script>
@endsection
