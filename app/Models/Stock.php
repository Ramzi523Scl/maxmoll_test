<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
	use SoftDeletes, HasFactory, Filterable, Sortable;

	protected $fillable = [
			'product_id',
			'warehouse_id',
			'stock',
		];

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function warehouse(): BelongsTo
	{
		return $this->belongsTo(Warehouse::class, 'warehouse_id');
	}
}
