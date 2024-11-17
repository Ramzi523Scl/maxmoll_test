<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;

class WarehouseSorter extends QuerySorter
{
	public function test($field, $direction): Builder
	{
		return $this->builder;
	}

}
