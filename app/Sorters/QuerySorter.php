<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QuerySorter
{
    protected Request $request;
    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
			$this->builder = $builder;
			$method = $field = $this->request->order_by_field ?? 'id';
			$direction = $this->request->order_by_direction ?? 'asc';

	    if (method_exists($this, $method)) {
		    call_user_func_array([$this, $method], [$field, $direction]);
	    } else {
				$builder->orderBy($field, $direction);
	    }
    }


}
