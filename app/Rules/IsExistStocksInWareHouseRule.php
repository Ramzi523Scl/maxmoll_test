<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsExistStocksInWareHouseRule implements ValidationRule
{
	private int $warehouse_id;
	private int $count;

	public function __construct(int $warehouse_id, int $count)
	{
		$this->warehouse_id = $warehouse_id;
		$this->count        = $count;
	}

	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$product = Product::find($value);

		if (!$product) {
			$fail('Продукт не найден.');
			return;
		}
		$warehouseStocksQuery = $product->stocks()->where('warehouse_id', $this->warehouse_id);

		$isExistProductInWareHouse = $warehouseStocksQuery->exists();

		if (!$isExistProductInWareHouse) {
			$fail('Товар отсутствует на выбранном складе.');
			return;
		}

		$isExistStocks = $warehouseStocksQuery->where('stock', '>=', $this->count)->exists();

		if (!$isExistStocks) {
			$fail('На складе недостаточно товара в нужном количестве.');
		}
	}
}
