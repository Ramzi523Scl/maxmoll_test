<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class IndexWarehouseRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,name',
			'order_by_direction' => 'nullable|string',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int|min:1',
		];
	}

}
