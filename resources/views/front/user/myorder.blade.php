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
                               <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                           </div>
                           <div class="card-body p-4">
                               <div class="table-responsive">
                                {{-- #region --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Orders #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    {{-- #endregion --}}
                                       <tbody>
                                           @if ($orders->isNotEmpty())
                                               @foreach ($orders as $order)
                                                   <tr>
                                                       <td>
                                                           <a href="{{ route('user.detailsOrder' , $order->id ) }}">OR{{ $order->id }}</a>
                                                       </td>
                                                       <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                       <td>
                                                        @if($order->status == 1)
                                                        <span class="badge bg-danger">Awating Delivered</span>
                                                        @else
                                                        <span class="badge bg-danger">Delivered</span>
                                                        @endif

                                                       </td>
                                                       <td>${{ $order->sub_total }}</td>
                                                   </tr>
                                               @endforeach
                                           @endif
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   @endsection

   @section('custom-js')
   @endsection
