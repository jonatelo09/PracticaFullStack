<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products = Product::paginate(5);
		return view('products.index')->with(compact('products'));
	}

	public function tienda() {
		$products = Product::paginate(6);
		//dd($products);
		return view('products.store')->with(compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$messages = [
			'name.required' => 'Es necesario ingresar un nombre para el producto',
			'name.min' => 'El nombre del producto debe tener al menos 5 caracteres',
			'price.required' => 'Es obligatorio definir un precio para el producto',
			'price.numeric' => 'Ingrese u  numero valido',
			'price.min' => 'No se admite valor Zero(0) o valores negativos!',
		];
		$rules = [
			'name' => 'required|min:5',
			'price' => 'required|numeric|min:1',
		];

		$this->validate($request, $rules, $messages);
		$product = Product::create($request->all());
		return redirect()->route('home')
			->with('notification', 'Producto Guardado con Éxito!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$product = Product::find($id);
		$product->name = $request->input('name');
		$product->price = $request->input('price');
		$product->save();
		return redirect()->route('home', $product->id)
			->with('notification', 'Producto actualizado con Éxito!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$product = Product::find($id);
		$product->delete();
		return redirect()->route('home')->with('notification2', 'El Producto se Elimino correctamente');
	}
}
