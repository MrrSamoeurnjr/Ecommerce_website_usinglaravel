<!-- <x-app-layout>
</x-app-layout> -->
<!DOCTYPE html>
<html lang="en">
  <head>
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
        <div style="padding-bottom: 30px" class="container-fluid page-body-wrapper">
            <div class="container" align="center">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <table>
                    <tr style="background-color: gray;">
                        <td style="padding: 20px;">Title</td>
                        <td style="padding: 20px;">Description</td>
                        <td style="padding: 20px;">Quantity</td>
                        <td style="padding: 20px;">Price</td>
                        <td style="padding: 20px;">Image</td>
                        <td style="padding: 20px;">Update</td>
                        <td style="padding: 20px;">Delete</td>
                    </tr>
                    @foreach($data as $product)
                    <tr align="center" style="background-color:black;">
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td><img height="100px" src="{{ asset('productimage/' . $product->image) }}" alt=""></td>
                        <td><a href="{{url('updateview' , $product->id)}}" class="btn btn-primary">Update</a></td>
                        <td><a href="{{url('deleteproduct' , $product->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @include('admin.script')
        </div>
      </div>
    </div>
  </body>
</html>