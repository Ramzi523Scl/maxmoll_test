<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name' => ['required', 'string'],
		];
	}

}
