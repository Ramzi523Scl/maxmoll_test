<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMove extends Model
{
	use SoftDeletes, HasFactory, Sortable, Filterable;

	protected $fillable = [
			'product_id',
			'warehouse_id',
			'change',
			'order_id',
			'reason',
		];

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function warehouse(): BelongsTo
	{
		return $this->belongsTo(Warehouse::class, 'warehouse_id');
	}

	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class, 'order_id');
	}
}
