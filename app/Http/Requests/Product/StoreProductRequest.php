<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'  => ['required', 'string'],
			'price' => ['required', 'integer'],
		];
	}
}
