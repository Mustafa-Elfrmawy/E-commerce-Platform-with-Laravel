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
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('user.updateInformation') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input value="{{ old('name', $user->name) }}" type="name" name="name"
                                            id="name" placeholder="Enter Your Name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input value="{{ old('email', $user->email) }}" type="email" name="email"
                                            id="email" placeholder="Enter Your Email"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        {{-- @dd($user->phone) --}}
                                        <input value="{{ old('phone', $user->phone ?? '') }}" type="text" name="phone"
                                            id="phone"
                                            placeholder="{{ empty($user->phone) ? 'your do not have a phone number' : $user->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone">Address</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5"
                                            placeholder="Enter Your Address">{{ old('address', $user->address ?? '') }}</textarea>
                                        @error('address')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        function logout() {
            if (!confirm('Are you sure you want to logout?')) {
                return;
            }
            $.ajax({
                url: "{{ route('user.logout') }}",
                type: "POST",
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = "{{ route('user.login') }}";
                    } else {
                        alert(response.message);
                    }
                },

                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error was occurred while logging out. Please try again.');
                }
            });
        }
    </script>
@endsection
