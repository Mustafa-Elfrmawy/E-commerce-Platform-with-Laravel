<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')

@section('title')
    Sub Category
@endsection

@section('content')

    @include('admin.layout.sidebar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Sub Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="subcategory.html" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form id="subcategoryForm" name="categoryForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            @if ($categories->isNotEmpty())
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @else
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Slug</label>
                                        <input type="text" readonly name="slug" id="slug" class="form-control"
                                            placeholder="Slug">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select type="text" name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Block</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Show-Home</label>
                                        <select type="text" name="show_home" id="status" class="form-control">
                                            <option {{ old('show_home') == 'yes' ? 'selected' : '' }} value="yes">show</option>
                                            <option {{ old('show_home') == 'no' ? 'selected' : '' }} value="no">no-show</option>
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
            </div>
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@section('custom-js')
    <script>
        $("#subcategoryForm").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $('button[type="submit"]').prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.sub-category.store') }}",
                type: "POST",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);
                    if (response['status'] == true) {
                        window.location.href = "{{ route('admin.sub-category.list') }}";
                    } else {

                        var errors = response.errors;
                        if (errors['name']) {
                            $('#name').addClass('is-invalid');
                            $('#name').next('.invalid-feedback').remove();
                            $('#name').after('<div class="invalid-feedback">' + errors['name'][0] +
                                '</div>');
                        }
                        if (errors['slug']) {
                            $('#slug').addClass('is-invalid');
                            $('#slug').next('.invalid-feedback').remove();
                            $('#slug').after('<div class="invalid-feedback">' + errors['slug'][0] +
                                '</div>');
                        }
                    }


                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });


        $("#name").change(function() {
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
