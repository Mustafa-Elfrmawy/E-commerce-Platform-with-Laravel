   @php
       use function App\Url\my_asset;
   @endphp
   @extends('front.layout.app')
   @section('Home')
       Shop
   @endsection

   @section('content')
       <section class="section-5 pt-3 pb-3 mb-3 bg-white">
           <div class="container">
               <div class="light-font">
                   <ol class="breadcrumb primary-color mb-0">
                       <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                       <li class="breadcrumb-item">Settings</li>
                   </ol>
               </div>
           </div>
       </section>

       <section class=" section-11 ">
           <div class="container  mt-5">
               <div class="row">
                   <div class="col-md-3">
                       @include('front.user.layout.message')
                       @include('front.user.layout.account-panel')
                   </div>
                   <div class="col-md-9">
                       <div class="card">
                           <div class="card-header">
                               <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                           </div>
                           <div class="card-body p-4">
                               <form method="POST" action="{{ route('user.changePassword.store') }}">
                                   @csrf
                                   <div class="row">
                                       <div class="mb-3">
                                           <label for="current_password">Current Password</label>
                                           <input type="password" name="current_password" id="current_password"
                                               placeholder="Current Password" class="form-control" required>
                                           @error('current_password')
                                               <span class="text-danger">{{ $message }}</span>
                                           @enderror
                                       </div>
                                       <div class="mb-3">
                                           <label for="password">New Password</label>
                                           <input type="password" name="password" id="password" placeholder="New Password"
                                               class="form-control" required>
                                           @error('password')
                                               <span class="text-danger">{{ $message }}</span>
                                           @enderror
                                       </div>
                                       <div class="mb-3">
                                           <label for="password_confirmation">Confirm New Password</label>
                                           <input type="password" name="password_confirmation" id="password_confirmation"
                                               placeholder="Confirm New Password" class="form-control" required>
                                       </div>
                                       <div class="d-flex">
                                           <button class="btn btn-dark" type="submit">Save</button>
                                       </div>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   @endsection

   @section('custom-js')
   @endsection
