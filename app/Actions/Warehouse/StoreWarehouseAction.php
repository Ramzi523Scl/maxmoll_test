<?php

namespace App\Actions\Warehouse;

use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Models\Warehouse;

class StoreWarehouseAction
{
	public function handle(StoreWarehouseRequest $request): Warehouse
	{
		$data = $request->validated();

		$warehouse = Warehouse::create($data);
		return $warehouse;
	}
}