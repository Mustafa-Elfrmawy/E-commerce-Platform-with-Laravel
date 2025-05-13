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
                {{-- @include('admin.layout.message') --}}
                @if (Session::has('errorImage'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('errorImage') }}
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
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
                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
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

                                        <!-- HTML -->

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="Image">Image</label>
                                                <div class="dropzone dz-clickable">
                                                    <div class="dz-message needsclick">
                                                        <br>
                                                        Drop files here or click to upload.<br><br>
                                                        <input type="file" style="width: 100%" id="imageValue"
                                                            name="image[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('image.0'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('image.0') }}
                                                </div>
                                            @endif
                                        </div>

                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="Image">Image</label>
                                                <div class="dropzone dz-clickable">
                                                    <div class="dz-message needsclick">
                                                        <br>
                                                        Drop files here or click to upload.<br><br>
                                                        <input type="file" style="width: 100%" id="imageValue"
                                                            name="image[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('image.0'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('image.0') }}
                                                </div>
                                            @endif
                                        </div> --}}



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
                                                        name="track_qty" checked>
                                                    <label for="track_qty" class="custom-control-label">Track
                                                        Quantity</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input value="{{ old('qty') }}" type="number" min="0"
                                                    name="qty" id="qty" class="form-control"
                                                    placeholder="qty">
                                            </div>
                                            @if ($errors->has('qty'))
                                                <div class="alert alert-danger mt-2">
                                                    {{ $errors->first('qty') }}
                                                </div>
                                            @endif
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
                                        @if ($errors->has('status'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
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
                                        @if ($errors->has('category'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('category') }}
                                            </div>
                                        @endif
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
                                        @if ($errors->has('sub_category'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('sub_category') }}
                                            </div>
                                        @endif
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
                                        @if ($errors->has('brand'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('brand') }}
                                            </div>
                                        @endif
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
                                        @if ($errors->has('is_featured'))
                                            <div class="alert alert-danger mt-2">
                                                {{ $errors->first('is_featured') }}
                                            </div>
                                        @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageValue');

            imageInput.addEventListener('change', function() {
                if (this.files.length > 10) {
                    alert('sorry you can not upload < 10 image.');
                    imageInput.value = null;
                }
            });
        });




        // // تهيئة المتغيرات
        // let myDropzone;
        // let uploadedIds = new Set();
        // let existingImages = []; // مصفوفة لتخزين الصور الموجودة مسبقًا
        // let isFormSubmitted = false; // متغير لتتبع حالة إرسال النموذج
        // let userId = null; // سيتم تعيينه لاحقًا

        // Dropzone.autoDiscover = false;

        // // استدعاء البيانات المخزنة عند تحميل الصفحة
        // $(document).ready(function() {
        //     // الحصول على معرف المستخدم من عنصر HTML مخفي
        //     userId = $('#user_id').val() || 'guest';

        //     // التحقق مما إذا كان النموذج قد تم إرساله سابقًا
        //     if (sessionStorage.getItem(`form_submitted_${userId}`) === 'true') {
        //         // إعادة تعيين الحالة
        //         sessionStorage.removeItem(`form_submitted_${userId}`);
        //         // حذف البيانات المخزنة محلياً
        //         clearLocalStorageData();
        //     } else {
        //         // استرجاع الصور المحفوظة في الجلسة أو من السيرفر
        //         loadSavedImages();
        //     }

        //     // تهيئة Dropzone
        //     initializeDropzone();

        //     // تهيئة معالج حدث تغيير العنوان لإنشاء الـ slug
        //     initializeTitleChangeHandler();

        //     // إضافة مستمع لحدث إغلاق النافذة أو تغيير الصفحة
        //     window.addEventListener('beforeunload', function(e) {
        //         // لا نريد تنفيذ هذا إذا كان النموذج قد تم إرساله
        //         if (!isFormSubmitted && existingImages.length > 0) {
        //             // حفظ الحالة مؤقتًا
        //             sessionStorage.setItem(`temp_images_${userId}`, JSON.stringify(existingImages));
        //         }
        //     });
        // });

        // // دالة لمسح بيانات التخزين المحلي المرتبطة بالمستخدم الحالي
        // function clearLocalStorageData() {
        //     localStorage.removeItem(`product_images_${userId}`);
        //     localStorage.removeItem(`product_session_id_${userId}`);
        //     sessionStorage.removeItem(`temp_images_${userId}`);

        //     uploadedIds = new Set();
        //     existingImages = [];
        // }

        // function loadSavedImages() {
        //     const savedImages = localStorage.getItem(`product_images_${userId}`);

        //     if (savedImages) {
        //         try {
        //             const parsedImages = JSON.parse(savedImages);
        //             existingImages = parsedImages;

        //             renderSavedImages(parsedImages);

        //             parsedImages.forEach(img => {
        //                 uploadedIds.add(img.id);
        //             });
        //         } catch (e) {
        //             console.error("خطأ في تحليل بيانات الصور المحفوظة:", e);
        //         }
        //     }

        //     // ٢. استرداد صور من السيرفر (باستخدام AJAX)
        //     $.ajax({
        //         url: "/admin/product/get-temp-images",
        //         type: "GET",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             user_id: userId,
        //             session_id: getSessionId()
        //         },
        //         success: function(response) {
        //             if (response.status === true && response.images && response.images.length > 0) {
        //                 response.images.forEach(image => {
        //                     if (!uploadedIds.has(image.id)) {
        //                         existingImages.push(image);
        //                         uploadedIds.add(image.id);
        //                         renderImageToGallery(image);
        //                     }
        //                 });

        //                 updateLocalStorage();
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("خطأ في استرجاع الصور المؤقتة:", error);
        //         }
        //     });
        // }

        // function renderSavedImages(images) {
        //     images.forEach(image => {
        //         renderImageToGallery(image);
        //     });
        // }

        // function renderImageToGallery(image) {
        //     let isSingleImage = existingImages.length === 1 ? 'single-image' : '';

        //     $('#product-gallery').append(`
    //         <div class="col-md-12 mb-4 ${isSingleImage}">
    //             <div class="card shadow-sm border-0 rounded">
    //                 <img src="${image.image_name}" class="card-img-top" alt="Image" style="height: 200px;">
    //                 <input type="hidden" value="${image.id}" name="image_id[]">
    //                 <input type="hidden" value="${image.image_name}" name="image_name">
    //                 <div class="card-body text-center">
    //                     <button class="btn btn-outline-danger btn-sm remove-image" data-id="${image.id}">
    //                         <i class="bi bi-trash"></i> Remove
    //                     </button>
    //                 </div>
    //             </div>
    //         </div>
    //     `);
        // }

        // function updateLocalStorage() {
        //     localStorage.setItem(`product_images_${userId}`, JSON.stringify(existingImages));
        // }

        // // تهيئة Dropzone
        // function initializeDropzone() {
        //     myDropzone = new Dropzone('.dropzone', {
        //         url: "{{ route('admin.product.uploadImage') }}",
        //         method: "POST",
        //         paramName: "images",
        //         maxFilesize: 2,
        //         maxFiles: 10,
        //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //         addRemoveLinks: true,
        //         parallelUploads: 10,
        //         uploadMultiple: true,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         sending: function(file, xhr, formData) {
        //             formData.append('session_id', getSessionId());
        //             formData.append('user_id', userId);
        //         },
        //         success: function(file, response) {
        //             if (response.status === true) {
        //                 response.images.forEach(function(image) {
        //                     if (!uploadedIds.has(image.id)) {
        //                         file.imageId = image.id;

        //                         existingImages.push(image);

        //                         renderImageToGallery(image);

        //                         uploadedIds.add(image.id);
        //                     }
        //                 });

        //                 updateLocalStorage();
        //             } else {
        //                 myDropzone.removeFile(file);
        //                 alert('فشل رفع الملف');
        //             }
        //         },
        //         error: function(file, response) {
        //             myDropzone.removeFile(file);
        //             alert('فشل رفع الملف');
        //         },
        //         init: function() {
        //             const dz = this;

        //             setTimeout(() => {
        //                 existingImages.forEach(image => {
        //                     if (image.image_name) {
        //                         const mockFile = { 
        //                             name: getFileNameFromUrl(image.image_name),
        //                             size: 12345,
        //                             accepted: true,
        //                             imageId: image.id
        //                         };

        //                         dz.displayExistingFile(mockFile, image.image_name);
        //                         dz.files.push(mockFile);
        //                     }
        //                 });
        //             }, 100);
        //         }
        //     });
        // }

        // function getFileNameFromUrl(url) {
        //     return url.split('/').pop();
        // }

        // function getSessionId() {
        //     let sessionId = localStorage.getItem(`product_session_id_${userId}`);
        //     if (!sessionId) {
        //         sessionId = `session_${userId}_${new Date().getTime()}_${Math.random().toString(36).substring(2, 15)}`;
        //         localStorage.setItem(`product_session_id_${userId}`, sessionId);
        //     }
        //     return sessionId;
        // }

        // function initializeTitleChangeHandler() {
        //     $("#title").change(function() {
        //         const nameValue = $(this).val();
        //         if (!nameValue) return;
        //         $('button[type="submit"]').prop('disabled', true);

        //         $.ajax({
        //             url: "{{ route('admin.category.slug') }}",
        //             type: "GET",
        //             data: {
        //                 title: nameValue
        //             },
        //             dataType: 'json',
        //             success: function(response) {
        //                 $('button[type="submit"]').prop('disabled', false);
        //                 if (response.status === true) {
        //                     $('#slug').val(response.slug);
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error("خطأ:", error);
        //             }
        //         });
        //     });
        // }

        // $(document).on('click', '.remove-image', function(e) {
        //     e.preventDefault();

        //     const imageId = $(this).data('id');
        //     const button = $(this);

        //     if (!confirm("هل أنت متأكد من حذف هذه الصورة؟")) {
        //         return;
        //     }

        //     $.ajax({
        //         url: "/admin/product/delete-image/" + imageId,
        //         type: 'DELETE',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             user_id: userId,
        //             session_id: getSessionId()
        //         },
        //         success: function(response) {
        //             if (response.status === true) {
        //                 button.closest('.col-md-12').fadeOut(300, function() {
        //                     $(this).remove();
        //                     if ($('#product-gallery').data('masonry')) {
        //                         $('#product-gallery').masonry('layout');
        //                     }
        //                 });

        //                 if (myDropzone) {
        //                     myDropzone.files.forEach(function(file) {
        //                         if (file.imageId == imageId) {
        //                             myDropzone.removeFile(file);
        //                         }
        //                     });
        //                 }

        //                 existingImages = existingImages.filter(img => img.id != imageId);

        //                 uploadedIds.delete(parseInt(imageId));

        //                 updateLocalStorage();

        //                 alert(response.message);
        //             } else {
        //                 alert(response.message);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("خطأ:", error);
        //             alert('حدث خطأ أثناء حذف الصورة.');
        //         }
        //     });
        // });

        // $('form').on('submit', function(e) {
        //     isFormSubmitted = true;
        //     sessionStorage.setItem(`form_submitted_${userId}`, 'true');

        //     $(this).append(`<input type="hidden" name="session_id" value="${getSessionId()}">`);
        //     $(this).append(`<input type="hidden" name="user_id" value="${userId}">`);
        // });

        // $(document).on('ajaxSuccess', function(event, xhr, settings) {
        //     if (settings.url === $('#product-form').attr('action') && xhr.responseJSON && xhr.responseJSON.status === true) {
        //         deleteAllTempImages();
        //     }
        // });

        // function deleteAllTempImages() {
        //     const currentSessionId = getSessionId();

        //     $.ajax({
        //         url: "/admin/product/clear-temp-images",
        //         type: "POST",
        //         data: {
        //             session_id: currentSessionId,
        //             user_id: userId,
        //             // force_delete: true
        //         },
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             console.log("تم حذف الصور المؤقتة بنجاح");
        //             clearLocalStorageData();
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("خطأ في حذف الصور المؤقتة:", error);
        //         }
        //     });
        // }

        // window.addEventListener('unload', function() {
        //     if (isFormSubmitted) {
        //         navigator.sendBeacon("/admin/product/clear-temp-images", new Blob([JSON.stringify({
        //             session_id: getSessionId(),
        //             user_id: userId,
        //             force_delete: true
        //         })], { type: 'application/json' }));
        //     }
        // });
    </script>
@endsection
@endsection
