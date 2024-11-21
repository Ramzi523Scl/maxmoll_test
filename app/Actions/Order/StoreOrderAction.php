<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Order;
use App\Models\ProductMove;
use App\Models\Stock;
use App\Traits\ProductMoves;

class StoreOrderAction
{
	use ProductMoves;
	public function handle(OrderRequest $request)
	{

		$data  = $request->validated();
		$items = $data['items'];
		unset($data['items']);

		\DB::beginTransaction();
			$order = Order::create($data);

			$order->items()->createMany($items);

			$this->updateStocks($items, $data['warehouse_id']);

			$this->saveMoves($order->id, $data['warehouse_id'], 'order_created', $items);
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