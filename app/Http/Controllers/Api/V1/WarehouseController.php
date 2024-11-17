<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Product\UpdateProductAction;
use App\Actions\Warehouse\DeleteWarehouseAction;
use App\Actions\Warehouse\IndexWarehouseAction;
use App\Actions\Warehouse\ShowWarehouseAction;
use App\Actions\Warehouse\StoreWarehouseAction;
use App\Actions\Warehouse\UpdateWarehouseAction;
use App\Filters\WarehouseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\IndexWarehouseRequest;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use App\Sorters\WarehouseSorter;

class WarehouseController extends Controller
{
	public function index(
		IndexWarehouseRequest $request,
		IndexWarehouseAction  $action,
		WarehouseFilter       $filter,
		WarehouseSorter       $sorter,
	) {
		return WarehouseResource::collection($action->handle($request, $filter, $sorter));
	}

	public function store(StoreWarehouseRequest $request, StoreWarehouseAction $action)
	{
		return new WarehouseResource($action->handle($request));
	}

	public function show(Warehouse $warehouse, ShowWarehouseAction $action)
	{
		return new WarehouseResource($action->handle($warehouse));
	}

	public function update(UpdateWarehouseRequest $request, Warehouse $warehouse, UpdateWarehouseAction $action)
	{
		return new WarehouseResource($action->handle($request, $warehouse));
	}

	public function destroy(Warehouse $warehouse, DeleteWarehouseAction $action)
	{
		$action->handle($warehouse);

		return response()->json();
	}
}
