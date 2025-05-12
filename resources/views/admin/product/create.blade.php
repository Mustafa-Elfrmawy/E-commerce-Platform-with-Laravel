<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')
@section('title')
    Dashboard
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="products.html" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{ route('admin.product.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input value="{{ old('title') }}" type="text" name="title"
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
                                                <input value="{{ old('slug') }}" type="text" readonly name="slug"
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
                                                    placeholder="Description">{{ old('description') }}</textarea>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="product-gallery">
                                            {{-- gallery --}}
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input value="{{ old('price') }}" type="text" name="price"
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
                                                <input value="{{ old('compare_price') }}" type="text"
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
                                                <input value="{{ old('sku') }}" type="text" name="sku"
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
                                                <input value="{{ old('barcode') }}" type="text" name="barcode"
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
                                                        name="track_qut" checked>
                                                    <label for="track_qty" class="custom-control-label">Track
                                                        Quantity</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input value="{{ old('qty') }}" type="number" min="0"
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
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Block
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
                                                        {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}
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
                                                        {{ old('sub_category') == $id ? 'selected' : '' }}>
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
                                                        {{ old('brand') == $id ? 'selected' : '' }}>{{ $name }}
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
                                            <option {{ old('is_featured') == 'no' ? 'selected' : '' }} value="no">No
                                            </option>
                                            <option {{ old('is_featured') == 'yes' ? 'selected' : '' }} value="yes">Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
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

// Create a variable to store Dropzone instance
let myDropzone;
let uploadedIds = new Set();

Dropzone.autoDiscover = false;

// Initialize Dropzone
$(document).ready(function() {
    myDropzone = new Dropzone('.dropzone', {
        url: "{{ route('admin.product.uploadImage') }}",
        method: "POST",
        paramName: "images",
        maxFilesize: 2,
        maxFiles: 10,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        parallelUploads: 10,
        uploadMultiple: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            if (response.status === true) {
                let isSingleImage = response.images.length === 1 ? 'single-image' : '';

                response.images.forEach(function(image) {
                    if (!uploadedIds.has(image.id)) {
                        // Store the file reference in the Dropzone file object for later removal
                        file.imageId = image.id;
                        
                        $('#product-gallery').append(`
                            <div class="col-md-12 mb-4 ${isSingleImage}">
                                <div class="card shadow-sm border-0 rounded">
                                    @if(old('image_name')!= null)
                                    <img src="{{old('image_name')}}" class="card-img-top" alt="Image" style="height: 200px;">
                                    @endif
                                    <img src="${image.image_name}" class="card-img-top" alt="Image" style="height: 200px;">
                                    <input type="hidden" value="${image.id}" name="image_id[]">
                                    <input type="hidden" value="${image.image_name}" name="image_name">
                                    <div class="card-body text-center">
                                        <button class="btn btn-outline-danger btn-sm remove-image" data-id="${image.id}">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `);
                        uploadedIds.add(image.id);
                    }
                });
            } else {
                myDropzone.removeFile(file);
                alert('File upload failed');
            }
        },
        error: function(file, response) {
            myDropzone.removeFile(file);
            alert('File upload failed');
        }
    });
});

// Enhanced click handler for remove-image button
$(document).on('click', '.remove-image', function(e) {
    e.preventDefault();

    const imageId = $(this).data('id');
    const button = $(this);

    if (!confirm("Are you sure you want to delete this image?")) {
        return;
    }

    $.ajax({
        url: "/admin/product/delete-image/" + imageId,
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
