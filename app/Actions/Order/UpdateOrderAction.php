<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Order;
use App\Models\Stock;
use App\Traits\ProductMoves;

/**
 * Класс для обработки обновления заказа.
 *
 * Обеспечивает:
 * - Восстановление остатков на складе по старым позициям заказа.
 * - Удаление старых позиций заказа.
 * - Добавление новых позиций заказа.
 * - Обновление остатков на складе по новым позициям.
 * - Обновление данных заказа.
 */
class UpdateOrderAction
{
	use ProductMoves;
	/**
	 * Выполняет обновление заказа.
	 *
	 * @param OrderRequest $request Запрос с валидированными данными для обновления.
	 * @param Order $order Заказ, который требуется обновить.
	 *
	 * @return Order Обновленный заказ с загруженными зависимыми моделями.
	 */
	public function handle(OrderRequest $request, Order $order): Order
	{
		$data = $request->validated();
		$items = $data['items'];
		unset($data['items']);

// todo: Дописать логику с движением товаров!

		\DB::beginTransaction();

			$this->restoreStocks($order->items, $data['warehouse_id']);
			$this->deleteOldItems($order);
			$this->createNewItems($order, $items);
			$this->deductStocks($items, $data['warehouse_id']);
			$this->updateOrder($order, $data);

		\DB::commit();

		return $order->load(['items.product', 'warehouse']);
	}

	/**
	 * Восстанавливает остатки на складе для старых позиций заказа.
	 *
	 * @param array $items Массив со старыми позициями.
	 * @param int $warehouseId ID склада, на котором нужно восстановить остатки.
	 *
	 * @return void
	 */
	private function restoreStocks(array $items, int $warehouseId): void
	{
		foreach ($items as $item) {
			$this->updateProductStocks($warehouseId, $item['product_id'], $item['count']);
		}
	}

	/**
	 * Удаляет все старые позиции заказа.
	 *
	 * @param Order $order Заказ, из которого нужно удалить позиции.
	 *
	 * @return void
	 */
	private function deleteOldItems(Order $order): void
	{
		$order->items()->delete();
	}

	/**
	 * Создает новые позиции для заказа.
	 *
	 * @param Order $order Заказ, в который нужно добавить новые позиции.
	 * @param array $itemsNew Массив новых позиций для создания.
	 *
	 * @return void
	 */
	private function createNewItems(Order $order, array $itemsNew): void
	{
		$order->items()->createMany($itemsNew);
	}

	/**
	 * Уменьшает остатки на складе для новых позиций заказа.
	 *
	 * @param array $items Массив новых позиций заказа.
	 * @param int $warehouseId ID склада, на котором нужно уменьшить остатки.
	 *
	 * @return void
	 */
	private function deductStocks(array $items, int $warehouseId): void
	{
		foreach ($items as $item) {
			$this->updateProductStocks($warehouseId, $item['product_id'], -$item['count']);
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

	/**
	 * Обновляет данные заказа.
	 *
	 * @param Order $order Заказ для обновления.
	 * @param array $data Данные для обновления заказа.
	 *
	 * @return void
	 */
	private function updateOrder(Order $order, array $data): void
	{
		$order->update($data);
	}
}
