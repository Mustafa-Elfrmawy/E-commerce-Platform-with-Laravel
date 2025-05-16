{{-- @dd($sub_categories) --}}

<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Brand</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.brand.list') }}" class="btn btn-primary">Back</a>
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
                        <form id="brandFrom" name="brandFrom" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">SupCategory</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control">

                                            @if (isset($sub_categories) && !empty($sub_categories))
                                                @foreach ($sub_categories as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
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
        $("#brandFrom").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $('button[type="submit"]').prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.brand.store') }}",
                type: "POST",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);
                    if (response['status'] == true) {
                        window.location.href = "{{ route('admin.brand.list') }}";
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
                        if (errors['status']) {
                            $('#status').addClass('is-invalid');
                            $('#status').next('.invalid-feedback').remove();
                            $('#status').after('<div class="invalid-feedback">' + errors['status'][0] +
                                '</div>');
                        }
                        if (errors['sub_category_id']) {
                            $('#sub_category_id').addClass('is-invalid');
                            $('#sub_category_id').next('.invalid-feedback').remove();
                            $('#sub_category_id').after('<div class="invalid-feedback">' + errors[
                                    'sub_category_id'][0] +
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

        // Dropzone.autoDiscover = false;

        // const dropzone = $('.dropzone').dropzone({
        //     url: "{{ route('admin.category.uploadImage') }}",
        //     method: "POST",
        //     paramName: "image",
        //     maxFilesize: 2,
        //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //     addRemoveLinks: true,
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     init: function() {
        //         this.on('addedfile', function(file) {
        //             if (this.files.length > 1) {
        //                 this.removeFile(this.files[0]);
        //             }
        //         });
        //     },
        //     success: function(file, response) {
        //         if (response.status === true) {
        //             $('#image').val(response.file_name);
        //             $('#imageValue').val(response.id);
        //         } else {
        //             this.removeFile(file);
        //             alert('File upload failed');
        //         }
        //     },
        //     error: function(file, response) {
        //         this.removeFile(file);
        //         alert('File upload failed');
        //     }
        // });
    </script>
@endsection
@endsection
