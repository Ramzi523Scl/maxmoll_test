<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes, HasFactory, Filterable, Sortable;

	protected $fillable = [
			'customer',
			'warehouse_id',
			'status',
			'completed_at',
		];

	protected $casts = [
			'completed_at' => 'timestamp',
		];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(function ($model) {
			$model->status = self::ACTIVE_STATUS;
		});

	}
	const STATUSES = [self::ACTIVE_STATUS, self::COMPLETED_STATUS, self::CANCELED_STATUS];
	const ACTIVE_STATUS = 'active';
	const COMPLETED_STATUS = 'completed';
	const CANCELED_STATUS = 'canceled';

	public function warehouse(): BelongsTo
	{
		return $this->belongsTo(Warehouse::class, 'warehouse_id');
	}

	public function items(): ?HasMany
	{
		return $this->hasMany(OrderItem::class, 'order_id', 'id');
	}

	public function products(): ?BelongsToMany
	{
		return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
			->withPivot('count');
	}
}
