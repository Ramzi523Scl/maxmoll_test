<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StockFactory extends Factory
{
	protected $model = Stock::class;

	public function definition(): array
	{
		$product_id = Product::all()->random()->id;
		$warehouse_id = Warehouse::all()->random()->id;
		return [
			'product_id'   => $product_id,
			'warehouse_id' => $warehouse_id,
			'stock'        => $this->faker->randomNumber(),
			'created_at'   => Carbon::now(),
			'updated_at'   => Carbon::now(),

		];
	}
}
