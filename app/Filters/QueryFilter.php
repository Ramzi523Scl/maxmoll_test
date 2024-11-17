<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
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

        foreach ($this->fields() as $method => $value) {
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], [$value]);
            }
        }
    }

    public function fields(): array
    {
        return $this->request->all();
    }
}
