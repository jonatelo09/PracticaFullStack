<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$total = DB::table('carts as ca')
			->join('products as pro', 'ca.product_id', '=', 'pro.id')
			->select('ca.id', 'pro.name', 'pro.price as precio', 'ca.quantity')
			->select('SUM(precio)');
		$carrito = Cart::join('products as pro', 'carts.product_id', '=', 'pro.id')
			->select('carts.id as id_cart', 'carts.quantity', 'pro.price', 'pro.name')
			->get();
		//dd($carrito);
		$carts = Cart::join('products as pro', 'carts.product_id', '=', 'pro.id')
			->select('carts.id as id_cart', 'carts.quantity', 'pro.price', 'pro.name')
		//->get();
			->paginate(5);
		return view('cart.index')->with(compact('carts', 'total', 'carrito'));
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
			'quantity.numeric' => 'Solo se admiten datos numericos.',
			'quantity.required' => 'La cantidad es Requerida!',
			'quantity.min' => 'No se admite valor Zero(0) o valores negativos!',
		];
		$rules = [
			'quantity' => 'required|numeric|min:1',
		];

		$this->validate($request, $rules, $messages);
		$cart = new Cart();
		$cart->product_id = $request->product_id;
		$cart->quantity = $request->input('quantity');
		$cart->save();
		return redirect()->route('carts')
			->with('notification', 'Se Agrego El Producto Al Carrito con Éxito!');

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Cart  $cart
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$cart = Cart::find($id);
		$cart->quantity = $request->input('quantity');
		$cart->save();
		return redirect()->route('carts')->with('notification', 'Carrito Actualizado con Éxito!!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Cart  $cart
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$product = Cart::find($id);
		$product->delete();
		return redirect()->route('carts')->with('notification2', 'El Producto se Elimino correctamente');
	}
}
