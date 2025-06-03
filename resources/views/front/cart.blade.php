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
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    @if ($carts->isNotEmpty())
        <section class=" section-9 pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table" id="cart">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subTotal = 0; @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $subTotal += $cart->product->price * $cart->quantity;
                                            $images = collect();
                                            if (!empty($cart->product->image_id)) {
                                                $images = App\Models\ProductImage::whereIn(
                                                    'id',
                                                    explode(',', $cart->product->image_id),
                                                )
                                                    ->latest()
                                                    ->pluck('image_product');
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if (file_exists(public_path('storage/' . $images->first())))
                                                        <img src="{{ my_asset('storage/' . $images->first()) }}"
                                                            width="100" height="100" alt="{{ $cart->product->title }}">
                                                    @else
                                                        <img src="{{ my_asset('Front/images/150x150.png') }}" width="100"
                                                            height="100" alt="{{ $cart->product->title }}">
                                                    @endif
                                                    <h2>{{ $cart->product->title }} </h2>
                                                </div>
                                            </td>
                                            <td id="price-{{ $cart->product_id }}">${{ $cart->product->price }}</td>
                                            <td>
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button
                                                            onclick="minusQuantity({{ $cart->product_id }}, {{ Auth::id() }})"
                                                            class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input id="qty-input-{{ $cart->product_id }}" type="text"
                                                        class="form-control form-control-sm border-0 text-center"
                                                        value="{{ $cart->quantity }}" readonly>
                                                    <div class="input-group-btn">
                                                        <button
                                                            onclick="plusQuantity({{ $cart->product_id }}, {{ Auth::id() }})"
                                                            class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td id="cart-total-{{ $cart->product_id }}">
                                                ${{ $cart->product->price * $cart->quantity }}
                                            </td>
                                            <td>
                                                <button
                                                    onclick="deleteCart({{ $cart->product_id }}, '{{ addslashes($cart->product->title) }}')"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @dd($subTotal) --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Cart Summery</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div id="subTotalPrice">${{ $subTotal }}</div>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping</div>
                                    <div>$0</div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div id="totalSales">${{ $subTotal }}</div>
                                </div>
                                <div class="pt-5">
                                    <a href="{{ route('front.checkout') }}" class="btn-dark btn btn-block w-100">Proceed to
                                        Checkout</a>
                                </div>
                            </div>
                        </div>


                        {{-- pay now --}}

                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('custom-js')
    <script>
        function plusQuantity(productId, userId) {
            $.ajax({
                url: "{{ route('front.plusQuantity') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    user_id: userId,
                },
                success: function(response) {
                    if (response.status === true) {
                        $('#qty-input-' + productId).val(response.new_quantity);

                        let cartTotalText = $('#cart-total-' + productId).text();
                        let priceText = $('#price-' + productId).text();
                        let subTotalPriceText = $('#subTotalPrice').text();

                        let subTotalPriceValue = parseFloat(subTotalPriceText.replace(/[^\d.]/g, '')) || 0;
                        let priceTotalValue = parseFloat(cartTotalText.replace(/[^\d.]/g, '')) || 0;
                        let priceFilterValue = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;

                        let newCartTotalValue = priceTotalValue + priceFilterValue;
                        let newSubTotalValue = subTotalPriceValue + priceFilterValue;

                        let newCartTotalText = '$' + newCartTotalValue.toFixed(2);
                        let newSubTotalText = '$' + newSubTotalValue.toFixed(2);

                        $('#subTotalPrice').text(newSubTotalText);
                        $('#totalSales').text(newSubTotalText);
                        $('#cart-total-' + productId).text(newCartTotalText);

                    } else {
                        alert(response.message);
                    }

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while updating the quantity.');
                }
            });
        }

        function minusQuantity(productId, userId) {
            $.ajax({
                url: "{{ route('front.minusQuantity') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    user_id: userId,
                },
                success: function(response) {
                    if (response.status === true) {
                        $('#qty-input-' + productId).val(response.new_quantity);

                        let cartTotalText = $('#cart-total-' + productId).text();
                        let priceText = $('#price-' + productId).text();
                        let subTotalPriceText = $('#subTotalPrice').text();

                        let subTotalPriceValue = parseFloat(subTotalPriceText.replace(/[^\d.]/g, '')) || 0;
                        let priceTotalValue = parseFloat(cartTotalText.replace(/[^\d.]/g, '')) || 0;
                        let priceFilterValue = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;

                        let newCartTotalValue = priceTotalValue - priceFilterValue;
                        let newSubTotalValue = subTotalPriceValue - priceFilterValue;

                        let newCartTotalText = '$' + newCartTotalValue.toFixed(2);
                        let newSubTotalText = '$' + newSubTotalValue.toFixed(2);

                        $('#subTotalPrice').text(newSubTotalText);
                        $('#totalSales').text(newSubTotalText);
                        $('#cart-total-' + productId).text(newCartTotalText);

                    } else {
                        alert(response.message);
                    }

                },

                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while updating the quantity.');
                }
            });
        }

        function deleteCart(productId, productTitle) {
            if (confirm('are you want delete this product: ' + productTitle)) {

                $.ajax({
                    url: "{{ route('front.deleteCart') }}",
                    type: "DELETE",
                    data: {
                        product_id: productId,
                        product_title: productTitle,
                    },
                    success: function(response) {
                        if (response.status === true) {
                            // alert(response.message);
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while deleting the cart item.');
                    }
                });
            }

        }
    </script>
@endsection
