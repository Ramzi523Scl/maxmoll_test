<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\IndexOrderAction;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Sorters\OrderSorter;

class OrderController extends Controller
{

	public function index(
		IndexOrderRequest $request,
		OrderFilter       $filter,
		OrderSorter       $sorter,
		IndexOrderAction  $action,
	) {
		return OrderResource::collection($action->handle($request, $filter, $sorter));
	}

	public function store(StoreOrderRequest $request, StoreOrderAction $action)
	{
		return new OrderResource($action->handle($request));
	}

	public function update(UpdateOrderRequest $request, Order $order, UpdateOrderAction $action)
	{
		return new OrderResource($action->handle($request, $order));

	}

}
