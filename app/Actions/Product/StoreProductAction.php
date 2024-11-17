<?php

namespace App\Actions\Product;

use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;

class StoreProductAction
{
	public function handle(StoreProductRequest $request): Product
	{
		$data = $request->validated();
		$product = Product::create($data);

		return $product;
	}

}