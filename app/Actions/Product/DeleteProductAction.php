<?php

namespace App\Actions\Product;

use App\Models\Product;

class DeleteProductAction
{
	public function handle(Product $product): void
	{
		$product->delete();
	}

}