<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
                    <form action="{{url('search')}}" class="form-inline" style="float: right ; padding: 10px">
                        @csrf
                        <input class="form-control" type="search" name="search" placeholder="search">
                        <input class="btn btn-success" type="submit">
                    </form>
                </div>
            </div>
            @foreach($data as $product)
                <div class="col-md-4">
                    <div class="product-item">
                       <a href="#"><img src="{{ asset('productimage/' . $product->image) }}" alt=""></a>
                        <div class="down-content">
                            <a href="#"><h4>{{ $product->title }}</h4></a>
                            <h6>${{ $product->price }}</h6>
                            <p>{{ $product->description }}</p>
                            <form action="{{url('addcart' ,$product->id)}}" method="post" name="quantity">
                            @csrf
                                <input type="number" value="1" min="1" class="form-control" name="" style="width:100px"><br>
                                <input type="submit" class="btn btn-primary" value="Add Cart">
                            </form>
                            <ul class="stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span>Reviews ({{ $product->reviews_count }})</span>
                        </div>
                    </div>
                </div>
            @endforeach 
            @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-center-center">
                {!! $data->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

