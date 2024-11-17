<?php

namespace App\Actions\Product;

use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;

class UpdateProductAction
{
	public function handle(UpdateProductRequest $request, Product $product): Product
	{
		$data = $request->validated();
		$product->load('stocks.warehouse')->update($data);

		return $product;
	}

}