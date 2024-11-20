<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends QueryFilter
{

	public function statuses($value): Builder
	{
		return $this->builder->whereIn('status', $value);
	}

	public function customer($value): Builder
	{
		return $this->builder->where('customer', $value);
	}

	public function warehouses($value): Builder
	{
		return $this->builder->whereIn('warehouse_id', $value);
	}

	public function products($value): Builder
	{
		return $this->builder->whereHas('items', function (Builder $query) use ($value) {
			$query->whereIn('product_id', $value);
		});
	}

}
