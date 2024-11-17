<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemFactory extends Factory
{
	protected $model = OrderItem::class;

	public function definition(): array
	{
		return [
			'order_id'   => Order::all()->random()->id,
			'product_id' => Product::all()->random()->id,
			'count'      => $this->faker->randomNumber(),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];
	}
}
