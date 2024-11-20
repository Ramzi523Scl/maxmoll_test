<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Order;
use App\Models\ProductMove;
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

			$this->moveSave($order, $items, $data['warehouse_id']);
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

	private function moveSave(Order $order, array $items, int $warehouse_id): void
	{
		$data = [
			'order_id' => $order->id,
			'warehouse_id' => $warehouse_id,
			'reason' => 'created',
		];

		foreach ($items as $item) {
			$data['product_id'] = $item['product_id'];
			$data['change'] = $item['count'];

			ProductMove::create($data);
		}

	}


}