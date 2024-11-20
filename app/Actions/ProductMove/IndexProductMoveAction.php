<?php

namespace App\Actions\ProductMove;

use App\Filters\ProductFilter;
use App\Http\Requests\ProductMove\IndexProductMoveRequest;
use App\Models\ProductMove;
use App\Sorters\ProductSorter;

class IndexProductMoveAction
{
	public function handle(IndexProductMoveRequest $request, ProductFilter $filter, ProductSorter $sorter)
	{
		return ProductMove::with(['product', 'warehouse'])
			->filter($filter)
			->sorter($sorter)
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);
	}

}