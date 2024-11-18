<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class CancelOrderRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'order' => [
				function ($attribute, $value, $fail) {
					$isActiveOrder = $this->order->status === Order::ACTIVE_STATUS;
					if (!$isActiveOrder) {
						$fail("Заказ с данным статусом невозможно отменить.");
					}
				}
			],
		];
	}

	public function validationData(): array
	{
		return array_merge($this->all(), $this->route()->parameters());
	}
}
