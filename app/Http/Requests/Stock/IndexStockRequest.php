<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class IndexStockRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,product_id,warehouse_id,stock',
			'order_by_direction' => 'nullable|string',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int|min:1',
		];
	}

}
