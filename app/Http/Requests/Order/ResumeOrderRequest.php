<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Rules\IsExistStocksForResumeRule;
use Illuminate\Foundation\Http\FormRequest;

class ResumeOrderRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'order' => [
				function ($attribute, $value, $fail) {

					$isCancelOrder = $this->order->status === Order::CANCELED_STATUS;
					if (!$isCancelOrder) {
						$fail("Заказ с данным статусом невозможно возобновить.");
					}
				},
				new IsExistStocksForResumeRule(),
			],
		];
	}

	public function validationData(): array
	{
		return array_merge($this->all(), $this->route()->parameters());
	}
}
