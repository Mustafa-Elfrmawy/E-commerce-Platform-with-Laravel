@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alert!</h4>
    {{Session::get('success')}}
  </div>
@endif

@if(Session::has('errors'))
@foreach ($errors->all() as $item)
        <div class="alert alert-danger">
            {{ $item }}
        </div>
@endforeach
@endif




@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alert!</h4>
    {{Session::get('error')}}
  </div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alert!</h4>
    {{Session::get('warning')}}
  </div>
@endif