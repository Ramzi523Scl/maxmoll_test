<?php

namespace App\Actions\Warehouse;

use App\Models\Warehouse;

class ShowWarehouseAction
{
	public function handle(Warehouse $warehouse)
	{
		return $warehouse;
	}
}