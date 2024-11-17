<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Stock;

class UpdateOrderAction
{
	public function handle(UpdateOrderRequest $request, Order $order): Order
	{

		$data  = $request->validated();
		$items = $data['items'];
		unset($data['items']);

		\DB::beginTransaction();
		$order->update($data);

			$this->updateOrderItems($order, $items);

		$this->updateStocks($items, $data['warehouse_id']);
		\DB::commit();

		return $order->load(['items.product', 'warehouse']);

	}

	private function updateOrderItems(Order $order, array $items): void
	{
		//todo: удалять все, возвращать в склад остатки, обратно добавлять и добавлять остатки

	}

	private function updateStocks(array $items, int $warehouse_id): void
	{
		foreach ($items as $item) {

			$stock = Stock::where('warehouse_id', $warehouse_id)
				->where('product_id', $item['product_id'])->first();

			$stock->stock -= $item['count'];
			$stock->save();

		}
	}


}