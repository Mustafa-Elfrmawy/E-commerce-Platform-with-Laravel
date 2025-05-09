<!-- /.navbar -->
<!-- Main Sidebar Container -->
@extends('admin.layout.app')
@section('title')
    Dashboard
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
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href=" {{ route('admin.brand.list') }}" class="btn btn-primary">Back</a>
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
                        <form id="categoryFrom" enctype="multipart/form-data" action="{{route('admin.brand.update' , $brand->id)}}" name="categoryFrom"  method="post">
                            @csrf    
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">SupCategory</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control">

                                            @if (isset($sub_categories) && !empty($sub_categories))
                                            @foreach ($sub_categories as $id => $name)
                                            <option value="{{ $id }}" {{ $id == $brand->sub_category_id ? 'selected': ''; }} >{{ $name }}</option>
                                            @endforeach
                                            @endif
                                         
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{$brand->name}}" name="name" id="name" class="form-control"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Slug</label>
                                        <input type="text" value="{{$brand->slug }}" name="slug" id="slug" readonly class="form-control"
                                            placeholder="Slug">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Image">Image</label>
                                        @if ( !empty($category->image_id) && ($category->image->name != null) )
                                            <img src="{{asset( 'storage/' . $category->image->name)}}" 
                                            alt="Category Image" class="img-fluid">
                                        @endif
                                        <div class="">
                                            <label for="">New_image</label>
                                            <br>
                                            <input type="file" name="image" id="">
                                        </div>
                                    </div>
                                </div> --}}
                                

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select type="text" name="status" id="status" class="form-control">
                                            <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Block</option>                                            
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
