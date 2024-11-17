<?php

namespace App\Actions\Stock;

use App\Filters\StockFilter;
use App\Http\Requests\Stock\IndexStockRequest;
use App\Models\Stock;
use App\Sorters\StockSorter;

class IndexStockAction
{
	public function handle(IndexStockRequest $request, StockFilter $filter, StockSorter $sorter)
	{
		return Stock::with(['product', 'warehouse'])
			->filter($filter)
			->sorter($sorter)
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);

	}

}