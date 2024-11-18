<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Order;
use App\Models\Stock;

class StoreOrderAction
{
	public function handle(OrderRequest $request)
	{

		$data  = $request->validated();
		$items = $data['items'];
		unset($data['items']);

		\DB::beginTransaction();
			$order = Order::create($data);

			$order->items()->createMany($items);

			$this->updateStocks($items, $data['warehouse_id']);
		\DB::commit();

		return $order->load(['items.product', 'warehouse']);

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