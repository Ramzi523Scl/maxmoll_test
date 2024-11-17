<?php

namespace App\Actions\Warehouse;

use App\Models\Warehouse;

class DeleteWarehouseAction
{
	public function handle(Warehouse $warehouse): void
	{
		$warehouse->delete();
	}
}