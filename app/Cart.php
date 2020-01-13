<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
	public function products() {
		return $this->hasMany(Product::class);
	}

	public function getTotalAttribute() {
		$total = 0;
		foreach ($this->products as $detail) {
			$total += $detail->quantity * $detail->carts->price;
		}

		return $total;
	}
}
