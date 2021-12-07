@extends('dashboard.layout')
@section('mytitle', 'Task- App')  
@section('main')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">View Cart</h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Cart</h6>
      </div>
      <div class="card-body">
         <table id="cart" class="table table-hover table-condensed">
            <thead>
               <tr>
                  <th style="width:50%">Product</th>
                  <th style="width:10%">Price</th>
                  <th style="width:8%">Quantity</th>
                  <th style="width:22%" class="text-center">Subtotal</th>
                  <th style="width:10%"></th>
               </tr>
            </thead>
            <tbody>
               @php $total = 0 @endphp
               @if(session('cart'))
               @foreach(session('cart') as $id => $details)
               @php $total += $details['price'] * $details['quantity'] @endphp
               <tr data-id="{{ $id }}">
                  <td data-th="Product">
                     <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{ asset('products_image')}}/{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                        <div class="col-sm-9">
                           <h4 class="nomargin">{{ $details['name'] }}</h4>
                        </div>
                     </div>
                  </td>
                  <td data-th="Price"> ₹ {{ $details['price'] }}</td>
                  <td data-th="Quantity">
                     <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                  </td>
                  <td data-th="Subtotal" class="text-center">₹ {{ $details['price'] * $details['quantity'] }}</td>
                  <td class="actions" data-th="">
                     <button class="btn btn-danger btn-sm remove-from-cart"> <i class="fas fa-trash"></i></button>
                  </td>
               </tr>
               @endforeach
               @endif
            </tbody>
            <tfoot>
               <tr>
                  <td colspan="5" class="text-right">
                     <h3><strong>Total  ₹ {{ $total }}</strong></h3>
                  </td>
               </tr>
               <tr>
                  <td colspan="5" class="text-right">
                     <a href="{{ url('allproduct') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                     <button class="btn btn-success">Checkout</button>
                  </td>
               </tr>
            </tfoot>
         </table>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<script type="text/javascript">

   
   
   $(".update-cart").change(function (e) {
     e.preventDefault();
   
     var ele = $(this);
   
     $.ajax({
         url: '{{ route('update.cart') }}',
         method: "patch",
         data: {
             _token: '{{ csrf_token() }}', 
             id: ele.parents("tr").attr("data-id"), 
             quantity: ele.parents("tr").find(".quantity").val()
         },
         success: function (response) {
            window.location.reload();
         }
     });
   });
   
   $(".remove-from-cart").click(function (e) {
     e.preventDefault();
   
     var ele = $(this);
   
     if(confirm("Are you sure want to remove?")) {
         $.ajax({
             url: '{{ route('remove.from.cart') }}',
             method: "DELETE",
             data: {
                 _token: '{{ csrf_token() }}', 
                 id: ele.parents("tr").attr("data-id")
             },
             success: function (response) {
                 window.location.reload();
             }
         });
     }
   });
   
</script>
@endsection