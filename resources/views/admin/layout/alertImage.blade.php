        @if ($errors->has('image'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                {{ $errors->first('image') }}
            </div>
        @endif

        @if (Session::has('errors'))
            @foreach ($errors->all() as $item)
                @if (
                    $item === 'The image.0 field must be a file of type: jpeg, png, jpg, gif, svg.' ||
                        $item === 'The image.0 field must be an image.' ||
                        $item === 'please upload your image again and check your error')
                    <div class="alert alert-danger">
                        {{ $item }}
                    </div>
                @endif
            @endforeach
        @endif


        @if (Session::has('error_image'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                {{ Session::get('error_image') }}
            </div>
        @endif

        @if (Session::has('errorImage'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                {{ Session::get('errorImage') }}
            </div>
        @endif
