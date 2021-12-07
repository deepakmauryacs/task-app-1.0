@extends('dashboard.layout')
@section('mytitle', 'Task- App')  
@section('main')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Product</h6>
         <a href="{{ url('/addproduct')}}" class="btn btn-primary" style="float: right; margin-top: -26px;">Add Product </a>
      </div>
      <div class="card-body">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Product Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>SKU Number</th>
                  <th>Image</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @php
               $i=1;
               @endphp
               @if(count($Product)>0)
               @foreach($Product->all() as $Product)
               <tr>
                  <td>{!! $i++ !!}</td>
                  <td>{!! $Product->product_name !!}</td>
                  <td>{!! $Product->quantity !!}</td>
                  <td>{!! $Product->price !!}</td>
                  <td>{!! $Product->sku !!}</td>
                  <td><img style="width: 50px;height: 50px;" class="img-profile rounded-circle"
                     src="{{ asset('products_image')}}/{!! $Product->product_image !!}">
                  <td>
                     <a href="{{ url('/addproduct')}}/{!! $Product->id !!}" class="btn btn-primary btn-icon-split">
                     <span class="icon text-white-50">
                     <i class="fas fa-edit"></i>
                     </span></a>
                     <a href="{{ url('/deleteproduct')}}/{!! $Product->id !!}" class="btn btn-danger btn-icon-split"  onclick="return confirm('Are you sure?')">
                     <span class="icon text-white-50">
                     <i class="fas fa-trash"></i>
                     </span></a>
                     <a  href="{{ route('addtocart', $Product->id) }}" class="btn btn-success btn-icon-split">
                     <span    class="icon text-white-50" >
                     ADD TO CART
                     </span></a>
                  </td>
               </tr>
               @endforeach
               @endif
            </tbody>
         </table>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>

@endsection