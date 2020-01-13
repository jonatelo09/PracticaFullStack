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
            <div class="head">

                <h3 class="text-center text-capitalize text-success">Lista de productos</h3>

            </div>
            <div class="row">
            	<div class="col-md-2 mb-2">
            		<button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#addProduct">Add</button>
            	</div>
            </div>
            <div class="table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($products as $product)
                        @if($product->id == null)
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$product->id}} </td>
                            <td>{{$product->name}} </td>
                            <td>${{number_format($product->price)}} </td>
                            <td>
                              <form method="post" action="{{url('/product/'.$product->id)}}">
                                @csrf
                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#editProduct{{$product->id}}">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                {{$products->render()}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Product -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="{{route('addProduct')}}">
      		@csrf
		  <div class="form-group">
		    <label for="exampleInputEmail1">Product Name</label>
		    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{old('name')}}">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Price</label>
		    <input type="number" class="form-control" name="price" placeholder="Price" required value="{{old('price')}}">
		  </div>

		  <button type="submit" class="btn btn-primary">Save</button>
		</form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit Product -->
@foreach($products as $product)
<div class="modal fade" id="editProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="{{url('/product/'.$product->id.'/edit')}}">
      		@csrf
		  <div class="form-group">
		    <label for="exampleInputEmail1">Product Name</label>
		    <input type="text" class="form-control" name="name" value="{{$product->name}}">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Price</label>
		    <input type="number" class="form-control" name="price" value="{{$product->price}}">
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection