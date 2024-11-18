<?php

namespace App\Rules;

use App\Models\Stock;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsExistStocksForResumeRule implements ValidationRule
{

	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$order       = $value;
		$warehouseId = $order->warehouse_id;

		$items = $order->items;

		foreach ($items as $item) {
			$isExistStocks = Stock::whereWarehouseId($warehouseId)->whereProductId($item->product_id)
				->where('stock', '>=', $item->count)->exists();

			if (!$isExistStocks) {
				$fail('Невозможно восстановить заказ. На складе недостаточно товара');
			}

		}

	}
}
