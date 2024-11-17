<?php

namespace App\Actions\Order;

use App\Filters\OrderFilter;
use App\Http\Requests\Order\IndexOrderRequest;
use App\Models\Order;
use App\Sorters\OrderSorter;

class IndexOrderAction
{
	public function handle(IndexOrderRequest $request, OrderFilter $filter, OrderSorter $sorter,)
	{

		return Order::filter($filter)
			->sorter($sorter)
			->with(['warehouse', 'items.product'])
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);

	}

}