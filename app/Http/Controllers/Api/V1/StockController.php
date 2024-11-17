<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Stock\IndexStockAction;
use App\Actions\Stock\ShowStockAction;
use App\Filters\StockFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\IndexStockRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use App\Sorters\StockSorter;

class StockController extends Controller
{
	public function index(
		IndexStockRequest $request,
		StockFilter       $filter,
		StockSorter       $sorter,
		IndexStockAction  $action
	) {
		return StockResource::collection($action->handle($request, $filter, $sorter));
	}

	public function show(Stock $stock, ShowStockAction $action)
	{
		return new StockResource($action->handle($stock));
	}


}
