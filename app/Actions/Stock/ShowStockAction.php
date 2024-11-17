<?php

namespace App\Actions\Stock;

use App\Models\Stock;

class ShowStockAction
{
	public function handle(Stock $stock): Stock
	{
		return $stock->load(['product', 'warehouse']);
	}

}