<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
	use SoftDeletes, HasFactory;

	protected $fillable = [
			'order_id',
			'product_id',
			'count',
		];

	protected static function boot(): void
	{
		parent::boot();
		static::creating(function ($model) {});

	}

	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
