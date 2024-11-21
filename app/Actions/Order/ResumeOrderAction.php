<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Stock;
use App\Traits\ProductMoves;
use Illuminate\Support\Collection;

class ResumeOrderAction
{
	use ProductMoves;
	public function handle(Order $order): void
	{
		\DB::beginTransaction();
			$this->deductStocks($order->items, $order->warehouse_id);

			$order->update(['status' => Order::ACTIVE_STATUS]);

			$this->saveMoves($order->id, $order->warehouse_id, 'order_resume', $order->items->toArray());
		\DB::commit();
	}

	/**
	 * Уменьшает остатки на складе для новых позиций заказа.
	 *
	 * @param Collection $items Массив новых позиций заказа.
	 * @param int $warehouseId ID склада, на котором нужно уменьшить остатки.
	 *
	 * @return void
	 */
	private function deductStocks(Collection $items, int $warehouseId): void
	{
		foreach ($items as $item) {
			$this->updateProductStocks($warehouseId, $item->product_id, -$item->count);
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