<?php

use App\Models\Order;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->string('customer');
			$table->foreignId('warehouse_id')->constrained((new Warehouse())->getTable());
			$table->enum('status', Order::STATUSES);
			$table->timestamp('completed_at')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('orders');
	}
};
