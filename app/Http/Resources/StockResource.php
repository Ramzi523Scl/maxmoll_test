<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Stock */
class StockResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [

			'id'         => $this->id,
			'stock'      => $this->stock,
			'product_id'   => $this->product_id,
			'warehouse_id' => $this->warehouse_id,
			'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

			'product'   => new ProductResource($this->whenLoaded('product')),
			'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
		];
	}
}
