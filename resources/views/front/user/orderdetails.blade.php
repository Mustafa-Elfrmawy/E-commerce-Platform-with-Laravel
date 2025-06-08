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
                        @include('front.user.layout.account-panel')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                            </div>

                            <div class="card-body pb-0">
                                <!-- Info -->
                                <div class="card card-sm">
                                    <div class="card-body bg-light mb-3">
                                        <div class="row">
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Order No:</h6>
                                                <!-- Text -->
                                                <p class="mb-lg-0 fs-sm fw-bold">
                                                    {{ $order->id }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                                <!-- Text -->
                                                <p class="mb-lg-0 fs-sm fw-bold">
                                                    <time datetime="{{ $order->created_at }}">
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                                                    </time>
                                                </p>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Status:</h6>
                                                <!-- Text -->
                                                @if ($order->status === 1)
                                                    <p class="mb-0 fs-sm fw-bold">Awating Delivery</p>
                                                @else
                                                    <p class="mb-0 fs-sm fw-bold">Delivered</p>
                                                @endif
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                                <!-- Text -->
                                                <p class="mb-0 fs-sm fw-bold">
                                                    @if (!$discount_user)
                                                        ${{ $order->sub_total }}
                                                    @else
                                                        {{-- @dd($discount_user) --}}
                                                        ${{ $discount_user->total_discount }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer p-3">

                                <!-- Heading -->
                                <h6 class="mb-7 h5 mt-4">Order Items (3)</h6>

                                <!-- Divider -->
                                <hr class="my-3">

                                <!-- List group -->
                                <ul>
                                    @foreach ($products as $index => $product)
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-4 col-md-3 col-xl-2">
                                                    @php
                                                        $Image = collect();
                                                        $Image = App\Models\ProductImage::find(
                                                            explode(',', $product->image_id)[0],
                                                        );
                                                    @endphp
                                                    <!-- Image -->
                                                    <a href="product.html">
                                                        @if ($Image)
                                                            <img src="{{ my_asset('storage/' . $Image->image_product) }}"
                                                                alt="..." class="img-fluid">
                                                    </a>
                                                @else
                                                    <img src="{{ my_asset('Front/images/150x150.png') }}" alt="..."
                                                        class="img-fluid"> </a>
                                    @endif
                            </div>
                            <div class="col">
                                <!-- Title -->
                                <p class="mb-4 fs-sm fw-bold">
                                    <a class="text-body"
                                        href="{{ route('front.product', $product->id) }}">{{ $product->title }} x
                                        {{ $quantity[$index] }}</a> <br>
                                    <span class="text-muted">${{ $product->price }}</span>
                                </p>
                            </div>
                        </div>
                        </li>
                        @endforeach
                        {{-- @if ($images->isNotEmpty())
                                @foreach ($images as $index => $filename)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ my_asset('storage/' . $filename->image_product) }}"
                                            class="d-block w-100" alt="Image {{ $index + 1 }}"
                                            style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            @else
                               
                            @endif --}}
                        </ul>
                    </div>
                </div>

                <div class="card card-lg mb-5 mt-3">
                    <div class="card-body">
                        <!-- Heading -->
                        <h6 class="mt-0 mb-3 h5">Order Total</h6>

                        <!-- List group -->
                        <ul>
                            <li class="list-group-item d-flex">
                                <span>Subtotal</span>
                                <span class="ms-auto">${{ $order->sub_total }}</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <span>Tax</span>
                                <span class="ms-auto">$0.00</span>
                            </li>
                            <li class="list-group-item d-flex">
                                <span>Shipping</span>
                                <span class="ms-auto">$0.00</span>
                            </li>
                            <li class="list-group-item d-flex fs-lg fw-bold">
                                <span>Total</span>
                                <span class="ms-auto">
                                    @if (!$discount_user)
                                        ${{ $order->sub_total }}
                                    @else
                                        ${{ $discount_user->total_discount }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
    @endsection

    @section('custom-js')
    @endsection
