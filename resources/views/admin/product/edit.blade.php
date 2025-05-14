<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')
@section('title')
    Product
@endsection


<style>
    #product-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
        /* لضمان توزيع الصور بشكل جيد */
    }

    #product-gallery .col-md-4 {
        flex: 1 1 calc(33.333% - 10px);
        max-width: calc(33.333% - 10px);
        box-sizing: border-box;
    }

    #product-gallery .col-md-4 img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    #product-gallery .col-md-4.single-image {
        flex: 1 1 100%;
    }
</style>
@section('content')
    @include('admin.layout.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                @include('admin.layout.message')
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.product.list') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $product->id }}" id="idProduct" name="id">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input value="{{ $product->title }}" type="text" name="title"
                                                    id="title" class="form-control" placeholder="Title">
                                                @if ($errors->has('title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('title') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input value="{{ $product->slug }}" type="text" readonly name="slug"
                                                    id="slug" class="form-control" placeholder="Slug">
                                                @if ($errors->has('slug'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('slug') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                    placeholder="Description">{{ $product->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="Image">Image</label>
                                                <div class="dropzone dz-clickable">
                                                    <div class="dz-message needsclick">
                                                        <br>
                                                        Drop files here or click to upload.<br><br>
                                                        <input type="file" style="width: 100%" id="imageValue"
                                                            name="image[]" accept="image/*" multiple
                                                            class="visually-hidden">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- alert --}}
                                            @include('admin.layout.alertImage')
                                        </div>
                                        @if ($images)
                                            @foreach ($images as $id => $name)
                                                <div class="col-md-12 mb-4 ${isSingleImage}">
                                                    <div class="card shadow-sm border-0 rounded">
                                                        @if ( file_exists(public_path('storage/' . $name)))
                                                            <img src="{{ asset('storage/' . $name) }}" class="card-img-top"
                                                                alt="Image" style="height: 200px;">
                                                        @else
                                                            <img src="{{ asset('product/images/default.png') }}"
                                                                class="card-img-top" alt="Image not found"
                                                                style="height: 200px;">
                                                        @endif
                                                        <div class="card-body text-center">
                                                            <button class="btn btn-outline-danger btn-sm remove-image"
                                                                data-id="{{ $id }}">
                                                                <i class="bi bi-trash"></i> Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        @endif


                                        <div class="row" id="product-gallery">
                                            {{-- gallery --}}
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input value="{{ $product->price }}" type="text" name="price"
                                                    id="price" class="form-control" placeholder="Price">
                                                @if ($errors->has('price'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('price') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compare_price">Compare at Price</label>
                                                <input value="{{ $product->compare_price }}" type="text"
                                                    name="compare_price" id="compare_price" class="form-control"
                                                    placeholder="Compare Price">
                                                @if ($errors->has('compare_price'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('compare_price') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sku">SKU (Stock Keeping Unit)</label>
                                                <input value="{{ $product->sku }}" type="text" name="sku"
                                                    id="sku" class="form-control" placeholder="sku">
                                                @if ($errors->has('sku'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('sku') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="barcode">Barcode</label>
                                                <input value="{{ $product->barcode }}" type="text" name="barcode"
                                                    id="barcode" class="form-control" placeholder="Barcode">
                                                @if ($errors->has('barcode'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('barcode') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="track_qty"
                                                        name="track_qty"
                                                        {{ $product->track_qty == 'yes' ? 'checked' : '' }}>
                                                    <label for="track_qty" class="custom-control-label">Track
                                                        Quantity</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input value="{{ $product->qty }}" type="number" min="0"
                                                    name="qty" id="qty" class="form-control"
                                                    placeholder="qty">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Block
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @if (isset($categories) && $categories != null)
                                                @foreach ($categories as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ $product->category_id == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_category">Sub category</label>
                                        <select name="sub_category" id="sub_category" class="form-control">
                                            <option value="">Select Sub Category</option>
                                            @if (isset($sub_categories) && $sub_categories != null)
                                                @foreach ($sub_categories as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ $product->sub_category_id == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <div class="mb-3">
                                        <select name="brand" id="brand" class="form-control">
                                            <option value="">Select Brand</option>
                                            @if (isset($brands) && $brands != null)
                                                @foreach ($brands as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ $product->brand_id == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Featured product</h2>
                                    <div class="mb-3">
                                        <select name="is_featured" id="status" class="form-control">
                                            <option {{ $product->is_featured == 'no' ? 'selected' : '' }} value="no">
                                                No
                                            </option>
                                            <option {{ $product->is_featured == 'yes' ? 'selected' : '' }} value="yes">
                                                Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@section('custom-js')
    <script>
        // Keep the existing code for slug generation
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



        // Enhanced click handler for remove-image button
        $(document).on('click', '.remove-image', function(e) {
            e.preventDefault();

            const imageId = $(this).data('id');
            const idProduct = $('#idProduct').val();
            const button = $(this);
            // console.log(imageId);

            if (!confirm("Are you sure you want to delete this image?")) {
                return;
            }

            $.ajax({
                url: "/admin/product/delete-image/" + imageId + '/' + idProduct,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === true) {
                        // Remove the card from the gallery
                        button.closest('.col-md-12').fadeOut(300, function() {
                            $(this).remove();
                            // If you're using masonry for layout
                            if ($('#product-gallery').data('masonry')) {
                                $('#product-gallery').masonry('layout');
                            }
                        });

                        // Remove the image preview from the Dropzone
                        if (myDropzone) {
                            // Find and remove the file from Dropzone
                            myDropzone.files.forEach(function(file) {
                                if (file.imageId == imageId) {
                                    myDropzone.removeFile(file);
                                }
                            });
                        }

                        // Remove from our tracking set
                        uploadedIds.delete(imageId);

                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert('An error occurred while deleting the image.');
                }
            });
        });
    </script>
@endsection
@endsection
