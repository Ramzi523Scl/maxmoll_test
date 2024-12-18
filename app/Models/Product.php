<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes, HasFactory, Filterable, Sortable;

	protected $fillable = [
			'name',
			'price',
		];

	public function stocks(): ?HasMany
	{
		return $this->hasMany(Stock::class, 'product_id');
	}
}
