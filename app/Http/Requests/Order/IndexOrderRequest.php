<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexOrderRequest extends FormRequest
{
	public function rules(): array
	{

		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,customer,warehouse_id,status',
			'order_by_direction' => 'nullable|string',
			'statuses'           => 'nullable|array',
			'statuses.*'         => ['required', 'string', Rule::in(Order::STATUSES)],
			'customer'           => 'nullable|string',
			'products'           => 'nullable|array',
			'products.*'         => ['required', 'integer', 'min:0', 'exists:products,id'],
			'warehouses'         => 'nullable|array',
			'warehouses.*'       => 'required|integer|min:0|exists:warehouses,id',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int|min:1',
		];
	}

}
