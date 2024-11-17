<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
	public function rules(): array
	{

		return [
			'order_by_field'     => 'nullable|string|in:id,created_at,category,price,weight,length',
			'order_by_direction' => 'nullable|string',
			'price_min'          => 'nullable|integer',
			'price_max'          => 'nullable|integer',
			'first'              => 'nullable|int|min:10|max:100',
			'page'               => 'nullable|int',
		];
	}

}
