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
                                            <input value="{{ old('first_name') }}" type="text" name="first_name"
                                                id="first_name" class="form-control" placeholder="First Name">
                                            @error('first_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('last_name') }}" type="text" name="last_name"
                                                id="last_name" class="form-control" placeholder="Last Name">
                                            @error('last_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input value="{{ old('email') }}" type="email" name="email" id="email"
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
                                            <input value="{{ old('phone') }}" type="text" name="mobile" id="mobile"
                                                class="form-control" placeholder="Mobile No.">
                                            @error('phone')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                class="form-control">{{ old('order_notes') }}</textarea>
                                            @error('order_notes')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                                    </div>
                                </form>
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
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">Product Name Goes Here X 1</div>
                                <div class="h6">$100</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">Product Name Goes Here X 1</div>
                                <div class="h6">$100</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">Product Name Goes Here X 1</div>
                                <div class="h6">$100</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">Product Name Goes Here X 1</div>
                                <div class="h6">$100</div>
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Subtotal</strong></div>
                                <div class="h6"><strong>$400</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="h6"><strong>Shipping</strong></div>
                                <div class="h6"><strong>$20</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 summery-end">
                                <div class="h5"><strong>Total</strong></div>
                                <div class="h5"><strong>$420</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="card payment-form ">
                        <h3 class="card-title h5 mb-3">Payment Details</h3>
                        <div class="card-body p-0">
                            <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input type="text" name="card_number" id="card_number"
                                    placeholder="Valid Card Number" class="form-control">
                                @error('card_number')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">Expiry Date</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY"
                                        class="form-control">
                                    @error('expiry_date')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv_code" class="mb-2">CVV Code</label>
                                    <input type="text" name="cvv_code" id="cvv_code" placeholder="123"
                                        class="form-control">
                                    @error('cvv_code')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                            </div>
                        </div>
                    @endsection
