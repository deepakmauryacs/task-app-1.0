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
      </div>
      <div class="card-body">
         <form id="forms" method="post"  class="custom-validation" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-6">
                  <label for="Product"> Product name</label>
                  <input type="text" name="product_name" value="{{ (!empty($Product->product_name) && $Product->product_name ? $Product->product_name : old('product_name'))  }}"  class="form-control">
                  <input type="hidden" name="edit_id" value="{{ (!empty($Product->id) && $Product->id ? $Product->id : old('id'))  }}"  class="form-control">
               </div>
               <div class="col-md-6 form-group">
                  <label for="pwd">Quantity:</label>
                  <input type="number" name="quantity"  value="{{ (!empty($Product->quantity) && $Product->quantity ? $Product->quantity : old('quantity'))  }}" min="0" class="form-control" >
               </div>
               <div class="col-md-6 form-group">
                  <label for="pwd"> Price: </label>
                  <input type="number" name="price"  value="{{ (!empty($Product->price) && $Product->quantity ? $Product->price : old('price'))  }}"  min="0" class="form-control" >
               </div>
               <div class="col-md-6 form-group">
                  <label for="pwd"> Product Image: </label>
                  <input type="file"  min="0" name="product_image" class="form-control" style="padding: 3px;" id="pwd">
               </div>
               <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-success">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<script type="text/javascript">
   $("#forms").submit(function(event) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      event.preventDefault();
      $.ajax({
              type: "POST",
              url:"{{ route('saveproduct') }}",
              dataType:'json',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,
              beforeSend:function()
              {},
              success:function(responce)
              {
                if(responce.status==0)
                {
                   toastr.error(responce.message);
                }else if(responce.status==1)
                {
                    toastr.success(responce.message);
                    window.location.href = "{{ route('allproduct') }}";
                   //  window.setTimeout(function() {
                   //   window.location.reload();
                   // }, 300);
                }
              },
              error:function()
              {
               // toastr.error('Something Went Wrong..');
              },
              complete:function()
              {
              }
          });
   })
</script>
@endsection