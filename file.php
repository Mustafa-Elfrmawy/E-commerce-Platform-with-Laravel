<!-- /.navbar -->
<!-- Main Sidebar Container -->
{{-- @dd($sub_categories) --}}
@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.product.list') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.product.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input value="{{ old('title') }}" type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug">Slug</label>
                                        <input value="{{ old('slug') }}" type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input value="{{ old('price') }}" type="text" name="price" id="price" class="form-control" placeholder="Price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input value="{{ old('compare_price') }}" type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sku">SKU</label>
                                        <input value="{{ old('sku') }}" type="text" name="sku" id="sku" class="form-control" placeholder="SKU">
                                    </div>

                                    <div class="mb-3">
                                        <label for="barcode">Barcode</label>
                                        <input value="{{ old('barcode') }}" type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                                    </div>

                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" {{ old('track_qty') == 'on' ? 'checked' : '' }}>
                                            <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        </div>
                                        <input value="{{ old('qty') }}" type="number" min="0" name="qty" id="qty" class="form-control mt-2" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Block</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product category</h2>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $id => $name)
                                            <option value="{{ $id }}" {{ old('brand') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@section('custom-js')
    <script>
        $("#title").change(function() {
            const nameValue = $(this).val();
            if (!nameValue) return;
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.category.slug') }}",
                type: "GET",
                data: {
                    title: nameValue
                },
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);
                    if (response.status === true) {
                        $('#slug').val(response.slug);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });
    </script>
@endsection
@endsection
<!-- /.navbar -->
<!-- Main Sidebar Container -->
{{-- @dd($sub_categories) --}}
@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.product.list') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.product.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input value="{{ old('title') }}" type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug">Slug</label>
                                        <input value="{{ old('slug') }}" type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input value="{{ old('price') }}" type="text" name="price" id="price" class="form-control" placeholder="Price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input value="{{ old('compare_price') }}" type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sku">SKU</label>
                                        <input value="{{ old('sku') }}" type="text" name="sku" id="sku" class="form-control" placeholder="SKU">
                                    </div>

                                    <div class="mb-3">
                                        <label for="barcode">Barcode</label>
                                        <input value="{{ old('barcode') }}" type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                                    </div>

                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" {{ old('track_qty') == 'on' ? 'checked' : '' }}>
                                            <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        </div>
                                        <input value="{{ old('qty') }}" type="number" min="0" name="qty" id="qty" class="form-control mt-2" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Block</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product category</h2>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $id => $name)
                                            <option value="{{ $id }}" {{ old('brand') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@section('custom-js')
    <script>
        $("#title").change(function() {
            const nameValue = $(this).val();
            if (!nameValue) return;
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.category.slug') }}",
                type: "GET",
                data: {
                    title: nameValue
                },
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);
                    if (response.status === true) {
                        $('#slug').val(response.slug);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });
    </script>
@endsection
@endsection
