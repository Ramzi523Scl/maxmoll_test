<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Support\Collection;

class CancelOrderAction
{
	public function handle(Order $order): void
	{
		\DB::beginTransaction();
			$this->restoreStocks($order->items, $order->warehouse_id);

			$order->update(['status' => Order::CANCELED_STATUS]);
		\DB::commit();
	}


	/**
	 * Восстанавливает остатки на складе для старых позиций заказа.
	 *
	 * @param Collection $items Массив со старыми позициями.
	 * @param int $warehouseId ID склада, на котором нужно восстановить остатки.
	 *
	 * @return void
	 */
	private function restoreStocks(Collection $items, int $warehouseId): void
	{
		foreach ($items as $item) {
			$this->updateProductStocks($warehouseId, $item['product_id'], $item['count']);
		}
	}

	/**
	 * Обновляет остатки продукта на складе.
	 *
	 * @param int $warehouseId ID склада.
	 * @param int $productId ID продукта.
	 * @param int $count Изменение остатков (положительное или отрицательное).
	 *
	 * @return void
	 *
	 */
	private function updateProductStocks(int $warehouseId, int $productId, int $count): void
	{
		$stock = Stock::where('warehouse_id', $warehouseId)
			->where('product_id', $productId)
			->first();

		$stock->stock += $count;
		$stock->save();
	}
}