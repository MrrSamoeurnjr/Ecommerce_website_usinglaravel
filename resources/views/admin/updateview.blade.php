<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
  </head>
  <style type="text/css">
        .title {
            color: white;
            padding-top: 100px;
            font-size: 25px;
        }
        label {
            display: inline-block;
            width: 200px;
        }
    </style>
  <body>
        @include('admin.navbar')
        @include('admin.sidebar')
        <!-- @include('admin.body') -->
        <div class="container-fluid page-body-wrapper" id="bunrong">
            <div class="container" align="center">
               <h1 class="title">Add Product</h1>
               @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
               <form action="{{ url('updateproduct' , $data->id) }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div style="padding:15px;">
                        <label>Product title</label>
                        <input style="color:black;" type="text" name="title" placeholder="Give a product title" value="{{$data->title}}" required>
                   </div>
                   <div style="padding:15px;">
                        <label>Price</label>
                        <input style="color:black;" type="number" name="price" placeholder="Give a price" value="{{$data->price}}" required>
                   </div>
                   <div style="padding:15px;">
                        <label>Description</label>
                        <input style="color:black;" type="text" name="description" placeholder="Give a description" value="{{$data->description}}" required>
                   </div>
                   <div style="padding:15px;">
                        <label>Quantity</label>
                        <input style="color:black;" type="text" name="quantity" placeholder="Product quantity" value="{{$data->quantity}}" required>
                   </div>
                   <div style="padding:15px;">
                        <label>Old Image</label>
                        <img height="100px" width="100px" src="/productimage/{{$data->image}}" alt="">
                   </div>
                   <div style="padding:15px;">
                        <label for="">Change the image</label>
                        <input type="file" name="file" required>
                   </div>
                   <div style="padding:15px;">
                        <input class="btn btn-success" type="submit" name="submit">
                   </div>
               </form>
            </div>
        </div>
        @include('admin.script')
        </div>
      </div>
    </div>
  </body>
</html>