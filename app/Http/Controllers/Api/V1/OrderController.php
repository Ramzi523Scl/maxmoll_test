<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\IndexOrderAction;
use App\Actions\Order\StoreOrderAction;
use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Sorters\OrderSorter;

class OrderController extends Controller
{

	public function index(IndexOrderAction $action, OrderFilter $filter, OrderSorter $sorter)
	{
		return OrderResource::collection($action->handle($filter, $sorter));
	}

	public function store(StoreOrderRequest $request, StoreOrderAction $action)
	{
		return new OrderResource($action->handle($request));
	}

}
