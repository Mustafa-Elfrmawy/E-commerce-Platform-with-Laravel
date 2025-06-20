@php
    use function App\Url\my_asset;
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en_AU">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('Home', 'Home')</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" type="text/css" href="{{ my_asset('Front/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ my_asset('Front/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ my_asset('Front/css/video-js.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ my_asset('Front/css/style.css') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ my_asset('admin-asset/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <!-- Dropzone -->
    {{-- <link rel="stylesheet" href="{{ my_asset('admin-asset/plugins/dropzone/min/dropzone.min.css') }}"> --}}
    <!-- Summernote -->
    {{-- <link rel="stylesheet" href="{{ my_asset('admin-asset/plugins/summernote/summernote.min.css') }}"> --}}
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ my_asset('admin-asset/css/adminlte.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ my_asset('admin-asset/css/custom.css') }}"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        #content_load {
            display: none;
        }

        #loader_load {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 9999;
            background: transparent;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body data-instant-intensity="mousedown">

    <!-- Loader -->
    <div id="loader_load"></div>

    <!-- Page content -->
    <div id="content_load">
        <div class="bg-light top-header">
            <div class="container">
                <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
                    <div class="col-lg-4 logo">
                        <a href="{{ route('front.shop') }}" class="text-decoration-none">
                            <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
                            <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
                        </a>
                    </div>
                    <div class="col-lg-6 col-6 text-left d-flex justify-content-end align-items-center">
                        @if (Auth::guard('user')->check())
                            <a href="{{ route('front.profile') }}" class="nav-link text-dark">My Account</a>
                        @else
                            <a href="{{ route('user.login') }}" class="nav-link text-dark">Sign-in</a>
                        @endif
                        <form action="">
                            <div class="input-group">
                                <input type="text" placeholder="Search For Products" class="form-control"
                                    aria-label="Search">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <header class="bg-dark">
            <div class="">
                <nav class="navbar navbar-expand-xl" id="navbar">
                    <a href="index.php" class="text-decoration-none mobile-logo">
                        <span class="h2 text-uppercase text-primary bg-dark">Online</span>
                        <span class="h2 text-uppercase text-white px-2">SHOP</span>
                    </a>
                    <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="navbar-toggler-icon fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if ($sub_categories->isNotEmpty())
                            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach ($sub_categories as $sub_category)
                                    <li class="nav-item dropdown">
                                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ $sub_category->name }}
                                        </button>
                                        @php
                                            $filteredCategories = $categories->where(
                                                'sub_category_id',
                                                $sub_category->id,
                                            );
                                        @endphp
                                        @if ($filteredCategories->isNotEmpty())
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                @foreach ($filteredCategories as $category)
                                                    <li><a class="dropdown-item nav-link"
                                                            href="{{ route('front.shop', $category->id) }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <a href="{{ route('front.showCart') }}" type="button"
                        class="btn btn-warning position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        @if (Auth::guard('user')->check())
                            <span id="cart-count"
                                class="position-absolute top-0  start-90 translate-middle badge rounded-pill bg-danger">
                                <span class="visually-hidden">unread messages</span>

                            </span>
                        @endif
                    </a>

                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="bg-dark mt-5">
            <div class="container pb-5 pt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>Get In Touch</h3>
                            <p>
                                No dolore ipsum accusam no lorem. <br>
                                123 Street, New York, USA <br>
                                example@example.com <br>
                                000 000 0000
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>Important Links</h3>
                            <ul>
                                <li><a href="about-us.php" title="About">About</a></li>
                                <li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>
                                <li><a href="#" title="Privacy">Privacy</a></li>
                                <li><a href="#" title="Terms">Terms & Conditions</a></li>
                                <li><a href="#" title="Refund">Refund Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>My Account</h3>
                            <ul>
                                <li><a href="#" title="Login">Login</a></li>
                                <li><a href="#" title="Register">Register</a></li>
                                <li><a href="#" title="Orders">My Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="copy-right text-center">
                                <p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ my_asset('Front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ my_asset('Front/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ my_asset('Front/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ my_asset('Front/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ my_asset('Front/js/slick.min.js') }}"></script>
    <script src="{{ my_asset('Front/js/custom.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.addEventListener('load', function() {
            document.getElementById('loader_load').style.display = 'none';
            document.getElementById('content_load').style.display = 'block';
        });

        function addToCart(productId, productTitle) {
            $.ajax({
                url: "{{ route('front.addToCart', ':id') }}".replace(':id', productId),
                type: "POST",
                data: {
                    product_id: productId,
                },
                success: function(response) {
                    if (response.status === true) {
                        if (confirm(response.message + ' ' + productTitle +
                                ', do you want to go to the cart?')) {
                            window.location.href = "{{ route('front.showCart') }}";
                        }
                    } else if (response.status === "non") {
                        alert(response.message);
                    } else {
                        alert(response.message + productTitle);
                    }
                },
                error: function(xhr, status, error) {
                    if (error == 'Unauthorized') {
                        if (confirm(error + ' :: You must be logged in to add items to the cart')) {} else {}
                    }
                }


            });
        }

        function quantityCartIcon() {
            $.ajax({
                url: "{{ route('front.quantityCartIcon') }}",
                type: "GET",
                success: function(response) {
                    if (response.status == true) {
                        $('#cart-count').text(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (error == 'Unauthorized') {
                        if (confirm(error + ' :: You must be logged in to add items to the cart')) {} else {}
                    }
                }
            });
        }

        function wishList(product_id) {
            $.ajax({
                url: "{{ route('user.wishList.store') }}",
                type: "POST",
                data: {
                    product_id: product_id,
                },
                success: function(response) {
                    if (response.status === true) {
                        alert(response.message);
                        // Change heart icon to full color yellow
                        $('a.whishlist[onclick*="wishList(' + product_id + ')"] i').removeClass('far').addClass(
                            'fas').css('color', 'yellow');
                        // window.location.reload();
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
    @if (Auth::guard('user')->check())
        <script>
            quantityCartIcon()
        </script>
    @endif
    @yield('custom-js')
</body>

</html>
