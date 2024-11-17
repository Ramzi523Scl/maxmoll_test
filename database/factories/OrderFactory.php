<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 *
 */
class OrderFactory extends Factory
{
	protected $model = Order::class;

	public function definition(): array
	{
		$warehouse_id = Warehouse::all()->random()->id;
		$status       = $this->faker->randomElement(Order::STATUSES);
		$completed_at = ($status == Order::COMPLETED_STATUS) ? now() : null;

		return [
			'customer'     => $this->faker->word(),
			'warehouse_id' => $warehouse_id,
			'status'       => $status,
			'completed_at' => $completed_at,
			'created_at'   => Carbon::now(),
			'updated_at'   => Carbon::now(),
		];
	}
}
