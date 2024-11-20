<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductMove;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{

		Product::factory(100)->create();
		Warehouse::factory(5)->create();
		Stock::factory(15)->create();
		Order::factory(100)->create();
		ProductMove::factory(30)->create();

	}
}
