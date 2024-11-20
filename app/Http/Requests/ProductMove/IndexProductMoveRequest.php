<?php

namespace App\Http\Requests\ProductMove;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductMoveRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,product_id,warehouse_id,change',
			'order_by_direction' => 'nullable|string',
			'created_at_start'   => 'nullable|date',
			'created_at_end'     => 'nullable|date',
			'products'           => 'nullable|array',
			'products.*'         => ['required', 'integer', 'min:0', 'exists:products,id'],
			'warehouses'         => 'nullable|array',
			'warehouses.*'       => 'required|integer|min:0|exists:warehouses,id',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int|min:1',
		];
	}

}
