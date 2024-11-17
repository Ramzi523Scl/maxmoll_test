<?php

namespace App\Actions\Warehouse;

use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Warehouse;

class UpdateWarehouseAction
{
	public function handle(UpdateWarehouseRequest $request, Warehouse $warehouse): Warehouse
	{
		$data = $request->validated();

		$warehouse->update($data);

		return $warehouse;
	}
}