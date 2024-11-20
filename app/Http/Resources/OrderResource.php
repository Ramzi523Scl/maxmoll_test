<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Order */
class OrderResource extends JsonResource
{
	public function toArray(Request $request): array
	{

		return [
			'id'           => $this->id,
			'customer'     => $this->customer,
			'warehouse_id' => $this->warehouse_id,
			'status'       => $this->status,
			'completed_at' => $this->completed_at?->format('Y-m-d H:i:s'),
			'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
			'updated_at'   => $this->updated_at?->format('Y-m-d H:i:s'),

			'items'     => OrderItemResource::collection($this->whenLoaded('items')),
			'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
		];
	}
}
