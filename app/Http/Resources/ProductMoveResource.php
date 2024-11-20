<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ProductMove */
class ProductMoveResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id'         => $this->id,
			'product_id'   => $this->product_id,
			'warehouse_id' => $this->warehouse_id,
			'change'     => $this->change,
			'order_id'     => $this->order_id,
			'reason'     => $this->reason,

			'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

			'product'   => new ProductResource($this->whenLoaded('product')),
			'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
			'order'     => new OrderResource($this->whenLoaded('order')),
		];
	}
}
