<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Rules\IsExistStocksInWareHouseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'customer'           => ['required', 'string', 'max:255'],
			'warehouse_id'       => ['required', 'integer', Rule::exists('warehouses', 'id')],
			'items'              => ['required', 'array', 'min:1'],
			'items.*.count'      => ['required', 'integer', 'min:1'],
			'items.*.product_id' => [
				'required',
				'integer',
				Rule::exists('products', 'id'),
				function ($attribute, $value, $fail) {
					$index        = explode('.', $attribute)[1];
					$count        = $this->input("items.{$index}.count");
					$warehouse_id = $this->input('warehouse_id');

					$rule = new IsExistStocksInWareHouseRule($warehouse_id, $count);
					$rule->validate($attribute, $value, $fail);
				},
			],
		];
	}

}
