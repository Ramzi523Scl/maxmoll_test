<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\OrderItem */
class OrderItemResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id'         => $this->id,
			'order_id'   => $this->order_id,
			'product_id' => $this->product_id,
			'count'      => $this->count,
			'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
			'updated_at'   => $this->updated_at?->format('Y-m-d H:i:s'),

			'order'   => new OrderResource($this->whenLoaded('order')),
			'product' => new ProductResource($this->whenLoaded('product')),
		];
	}
}
