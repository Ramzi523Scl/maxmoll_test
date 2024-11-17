<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends QueryFilter
{

	public function price_min($value): Builder
	{
		return $this->builder->where('price', '>=', $value);
	}

	public function price_max($value): Builder
	{
		return $this->builder->where('price', '<=', $value);
	}

}
