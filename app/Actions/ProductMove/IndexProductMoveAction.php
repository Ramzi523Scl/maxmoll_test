<?php

namespace App\Actions\ProductMove;

use App\Filters\ProductMoveFilter;
use App\Http\Requests\ProductMove\IndexProductMoveRequest;
use App\Models\ProductMove;
use App\Sorters\ProductMoveSorter;

class IndexProductMoveAction
{
	public function handle(IndexProductMoveRequest $request, ProductMoveFilter $filter, ProductMoveSorter $sorter)
	{
		return ProductMove::with(['product', 'warehouse'])
			->filter($filter)
			->sorter($sorter)
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);
	}

}