<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
	protected $model = Product::class;

	public function definition(): array
	{
		return [
			'name'       => $this->faker->word(),
			'price'      => $this->faker->randomFloat(8, 0, 100000),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];
	}
}
