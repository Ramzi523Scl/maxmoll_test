<?php

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('stocks', function (Blueprint $table) {
			$table->id();
			$table->foreignId('product_id')->constrained((new Product())->getTable());
			$table->foreignId('warehouse_id')->constrained((new Warehouse())->getTable());
			$table->integer('stock');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('stocks');
	}
};
