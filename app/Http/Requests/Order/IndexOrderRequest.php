<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class IndexOrderRequest extends FormRequest
{
	public function rules(): array
	{

		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,customer,warehouse_id,status',
			'order_by_direction' => 'nullable|string',
			'statuses'             => 'nullable',
			'warehouse_ids'      => 'nullable|integer|min:0',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int|min:1',
		];
	}

}
