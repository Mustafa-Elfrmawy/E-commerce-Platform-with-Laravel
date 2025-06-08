{{-- @if ($errors->any())
@dd($errors->all())
@endif --}}
@extends('front.layout.app')

@section('Home')
    Shop
@endsection

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                <form action="{{ route('front.checkout.store') }}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('first_name')?? explode(' ' , auth()->guard('user')->user()->name)[0] }}" type="text" name="first_name"
                                                id="first_name" class="form-control" placeholder="First Name">
                                            @error('first_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('last_name')??  explode(' ' , auth()->guard('user')->user()->name)[1]?? "" }}" type="text" name="last_name"
                                                id="last_name" class="form-control" placeholder="Last Name">
                                            @error('last_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('email')?? auth()->guard('user')->user()->email }}" type="email" name="email" id="email"
                                                class="form-control" placeholder="Email">
                                            @error('email')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">select Country</option>
                                                @if ($countries->isNotEmpty())
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">empty</option>
                                                @endif
                                            </select>
                                            @error('country')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ old('address') }}</textarea>
                                            @error('address')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('apartment') }}" type="text" name="apartment"
                                                id="apartment" class="form-control"
                                                placeholder="Apartment, suite, unit, etc. (optional)">
                                            @error('apartment')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input value="{{ old('city') }}" type="text" name="city" id="city"
                                                class="form-control" placeholder="City">
                                            @error('city')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input value="{{ old('state') }}" type="text" name="state" id="state"
                                                class="form-control" placeholder="State">
                                            @error('state')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input value="{{ old('zip') }}" type="text" name="zip" id="zip"
                                                class="form-control" placeholder="Zip">
                                            @error('zip')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('phone') }}" type="text" name="phone"
                                                id="mobile" class="form-control" placeholder="Mobile No.">
                                            @error('phone')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="notes_order" id="notes_order" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                class="form-control">{{ old('order_notes') }}</textarea>
                                            @error('notes_order')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summery</h2>
                    </div>
                    <div class="card cart-summery">
                        <div class="card-body">
                            @php
                                $sub_total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                                @php
                                    $sub_total += (float) $cart->total_price;
                                @endphp
                                <div class="d-flex justify-content-between pb-2">
                                    <div class="h6">{{ $cart->product->title }} x {{ $cart->quantity }}</div>
                                    <div class="h6">${{ $cart->product->price * $cart->quantity }}</div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Subtotal</strong></div>
                                <div class="h6"><strong>${{ $sub_total }}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="h6"><strong>Shipping</strong></div>
                                <div class="h6"><strong>$0</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 summery-end">
                                <div class="h5"><strong>Total</strong></div>
                                <div class="h5"><strong>${{ $sub_total }}</strong></div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-2 summery-end" id="total-discount">
                                <div class="h5"><strong>Total_Discount</strong></div>
                                @if($discountUser)
                                <div class="h5"><strong id="discount-value">${{$discountUser->total_discount}}</strong></div>
                                @else
                                <div class="h5"><strong id="discount-value"></strong></div>
                                @endif
                            </div>
                            @if($discountUser)
                            {{-- @dd($discountUser) --}}
                            <input  value="{{$discountUser->total_discount}}" name="discount_value_input" id="discount-value_input" type="hidden">
                            @else
                            <input   name="discount_value_input" id="discount-value_input" type="hidden">
                            @endif
                        </form>



                        </div>
                    </div>

                    <div class="input-group apply-coupan mt-4">
                        <form method="post" id="couponForm">
                            <input type="text" placeholder="Coupon Code" class="form-control" id="coupon_code"
                                name="coupon_code">
                            <button class="btn btn-dark mt-3" type="button" id="button-addon2"
                                onclick="applyDiscount()">Apply Coupon</button>
                        </form>
                    </div>

                    <div id="coupon-message" class="mt-2"></div>

                @section('custom-js')
                    <script>
                        function applyDiscount() {
                            var code = $('#coupon_code').val();

                            if (code.trim() === '') {
                                $('#coupon-message').html('<div class="alert alert-danger">Please enter a coupon code.</div>');
                                return;
                            }

                            $.ajax({
                                url: '{{ route('front.applyCoupon') }}',
                                type: 'POST',
                                data: {
                                    coupon_code: code,
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $('#total-discount').show();

                                        $('#discount-value').text('$' + response.discount)
                                        $('#discount-value_input').val(response.discount)

                                        $('#coupon-message').html('<div class="alert alert-success">' + response.message +
                                            '</div>');

                                    } else {
                                        $('#total-discount').hide();

                                        $('#coupon-message').html('<div class="alert alert-danger">' + response.message +
                                            '</div>');
                                    }
                                },
                                error: function(xhr) {
                                    $('#total-discount').hide();
                                    $('#coupon-message').html(
                                        '<div class="alert alert-danger">An error occurred. Please try again.</div>');
                                }
                            });
                        }
                    </script>
                @endsection
            @endsection
