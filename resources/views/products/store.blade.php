@extends('layouts.app')

@section('content')
<div class="wrapper">
	<div class="row justify-content-center">
		<h3 class="text-info mb-4">Tienda de Productos</h3>
	</div>
  <div class="row">
    <div class="col-sm-12">
      @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              </ul>
            </div>
          @endif
    </div>
  </div>
    <div class="row">
    	@foreach($products as $product)
      @if($product->id == 0)
      <p class="text-info text-uppercase">No existe productos en la tienda!</p>
      @else
        <div class="col-md-4 mb-5">
        	<div class="card" style="width: 18rem;">
    			  <div class="card-body">
              <input type="hidden" name="product_id" value="{{$product->id}}">
    			    <h5 class="card-title">{{$product->name}} </h5>
    			    <h6 class="card-subtitle mb-2 text-muted">$ {{$product->price}} </h6>
    			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    			    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCart{{$product->id}}"><i class="material-icons">
    				add_shopping_cart
    				</i></button>
    			  </div>
    			</div>
      </div>
      @endif
      @endforeach
    </div>
    {{$products->render()}}
</div>
<!-- Modal Add Product to Cart -->
@foreach($products as $product)
<div class="modal fade" id="addCart{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product to Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form method="post" action="{{route('addCart')}}">
      		@csrf
		  <div class="form-group">
		    <label for="exampleInputEmail1">Quantity Product</label>
		    <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" value="1" required>
		    <input type="hidden" name="product_id" value="{{$product->id}}">
		  </div>
		  <button type="submit" class="btn btn-primary">Add <span><i class="material-icons">send</i></span></button>
		</form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection