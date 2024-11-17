<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class StoreOrderAction
{
	public function handle(StoreOrderRequest $request)
	{

		$data = $request->validated();
		$order = Order::create($data);

		return $order;

	}


}