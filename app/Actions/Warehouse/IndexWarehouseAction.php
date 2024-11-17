<?php

namespace App\Actions\Warehouse;

use App\Filters\WarehouseFilter;
use App\Http\Requests\Warehouse\IndexWarehouseRequest;
use App\Models\Warehouse;
use App\Sorters\WarehouseSorter;

class IndexWarehouseAction
{

	public function handle(IndexWarehouseRequest $request, WarehouseFilter $filter, WarehouseSorter $sorter)
	{
		return Warehouse::filter($filter)->sorter($sorter)
			->paginate($request->first ?? 10, ['*'], 'page', $request->page ?? 1);
	}

}