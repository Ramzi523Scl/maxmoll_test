<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\CancelOrderAction;
use App\Actions\Order\CompleteOrderAction;
use App\Actions\Order\IndexOrderAction;
use App\Actions\Order\ResumeOrderAction;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Http\Requests\Order\CompleteOrderRequest;
use App\Http\Requests\Order\IndexOrderRequest;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\Order\ResumeOrderRequest;
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

	public function store(OrderRequest $request, StoreOrderAction $action)
	{
		return new OrderResource($action->handle($request));
	}

	public function update(OrderRequest $request, Order $order, UpdateOrderAction $action)
	{
		return new OrderResource($action->handle($request, $order));
	}

	public function complete(CompleteOrderRequest $request, Order $order, CompleteOrderAction $action)
	{
		$action->handle($order);

		return response()->json();
	}

	public function cancel(CancelOrderRequest $request, Order $order, CancelOrderAction $action)
	{
		$action->handle($order);

		return response()->json();
	}

	public function resume(ResumeOrderRequest $request, Order $order, ResumeOrderAction $action)
	{
		$action->handle($order);

		return response()->json();
	}

}
