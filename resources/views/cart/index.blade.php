@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@if (session('notification'))
        	<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>{{ session('notification') }}</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
        	@endif
        	@if (session('notification2'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('notification2') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
            <div class="head">
	            <h3 class="text-center text-capitalize text-info"><i class="material-icons">
					add_shopping_cart
					</i> Carrito de Compras <i class="material-icons">
					add_shopping_cart
					</i></h3>
            </div>
            <div class="table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>SubTotal</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($carts as $cart)
                    	@if($cart->id_cart == null)
                    	<tr>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        </tr>
                        @else
                        <tr class="text-left">
                            <td>{{$cart->id_cart}} </td>
                            <td>{{$cart->name}} </td>
                            <td>{{$cart->quantity}} </td>
                            <td>${{number_format($cart->price)}} </td>
                            <td>${{number_format($total = $cart->price * $cart->quantity)}} </td>
                            <td>
                            	<form method="post" action="{{url('/carts/'.$cart->id_cart)}}">
                            		@csrf
                            		<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#editCart{{$cart->id_cart}}">Edit</a>
                                	<button class="btn btn-danger btn-sm">Delete</button>
                            	</form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                    	<div class="row">
                    		<div class="col-sm-3">
                    		</div>
                    	</div>
                    </tfoot>
                </table>
            </div>
            <div class="row justify-content-end">
            	<div class="col-sm-2">
            		<button class="btn btn-success btn-md btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">Print</button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add Product to Cart -->
@foreach($carts as $cart)
<div class="modal fade" id="editCart{{$cart->id_cart}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product to Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="{{url('carts/'.$cart->id_cart.'/edit')}}">
      		@csrf
		  <div class="form-group">
		    <label for="exampleInputEmail1">Quantity Product  <span class="text-uppercase">"{{$cart->name}}"</span></label>
		    <input type="number" class="form-control" name="quantity" value="{{$cart->quantity}}">
		  </div>
		  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addCart{{$cart->id}}">Add</button>
		</form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Modal Add Product to Cart -->
@foreach($carts as $cart)
<div class="modal fade bd-example-modal-lg" id="printCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del Carrito de Compras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<div class="row">
      		<div class="col-sm-5">
      			<img src="{{url('img/motos.jpg')}}">
      		</div>
      		<div class="col-sm-7">
      			<ul>
      				@foreach($carts as $cart)
      				<li class="text-uppercase text-info">{{$cart->name}}} -- ${{number_format($suma = $cart->price)}}</li>
      				@endforeach
      			</ul>
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-sm-3">
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection