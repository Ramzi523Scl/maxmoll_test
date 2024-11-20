<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductMoveFilter extends QueryFilter
{

	public function warehouses($value): Builder
	{
		return $this->builder->whereIn('warehouse_id', $value);
	}

	public function products($value): Builder
	{
		return $this->builder->whereIn('product_id', $value);
	}

	public function created_at_start($value): Builder
	{
		return $this->builder->where('created_at', '>=', $value);
	}

	public function created_at_end($value): Builder
	{
		return $this->builder->where('created_at', '<=', $value);
	}

}
