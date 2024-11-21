<?php

namespace App\Actions\Order;

use App\Models\Order;

class CompleteOrderAction
{
	public function handle(Order $order): void
	{
		$order->update(['status' => Order::COMPLETED_STATUS, 'completed_at' => now()]);
	}


}