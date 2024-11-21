<?php

namespace App\Traits;

use App\Models\ProductMove;

trait ProductMoves
{
	public function saveMoves(int $orderId, int $warehouseId, string $reason, array $items): void
	{
		foreach ($items as $item) {
			ProductMove::create([
				'order_id' => $orderId,
				'warehouse_id' => $warehouseId,
				'product_id' => $item['product_id'],
				'change' => $item['count'],
				'reason' => $reason,
			]);
		}
	}

}