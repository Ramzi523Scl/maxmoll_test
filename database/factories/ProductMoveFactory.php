<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductMove;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductMoveFactory extends Factory
{
	protected $model = ProductMove::class;

	public function definition(): array
	{
		$order_id = Order::all()->random()->id;
		$product_id = Product::all()->random()->id;
		$warehouse_id = Warehouse::all()->random()->id;

		return [

			'change'     => $this->faker->randomNumber(),
			'reason'     => $this->faker->randomElement(Order::STATUSES),

			'product_id'   => $product_id,
			'warehouse_id' => $warehouse_id,
			'order_id'     => $order_id,

			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];
	}
}
