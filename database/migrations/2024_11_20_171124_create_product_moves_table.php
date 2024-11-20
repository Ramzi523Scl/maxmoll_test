<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('product_moves', function (Blueprint $table) {
			$table->id();
			$table->foreignId('product_id')->constrained((new Product())->getTable());
			$table->foreignId('warehouse_id')->constrained((new Warehouse())->getTable());
			$table->integer('change');
			$table->foreignId('order_id')->constrained((new Order())->getTable());
			$table->string('reason');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('product_moves');
	}
};
