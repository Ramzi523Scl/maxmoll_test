<?php

namespace App\Traits;

use App\Sorters\QuerySorter;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @param Builder $builder
     * @param QuerySorter $filter
     */
    public function scopeSorter(Builder $builder, QuerySorter $filter)
    {
        $filter->apply($builder);
    }
}
