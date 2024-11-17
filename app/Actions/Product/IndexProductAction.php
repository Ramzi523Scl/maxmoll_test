<?php

namespace App\Actions\Product;

use App\Filters\ProductFilter;
use App\Http\Requests\Product\IndexProductRequest;
use App\Models\Product;
use App\Sorters\ProductSorter;

class IndexProductAction
{
	public function handle(IndexProductRequest $request, ProductFilter $filter, ProductSorter $sorter)
	{
		return Product::with('stocks.warehouse')
		  ->filter($filter)
			->sorter($sorter)
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);
	}

}