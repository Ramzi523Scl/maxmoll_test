<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\ProductMove\IndexProductMoveAction;
use App\Filters\ProductMoveFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductMove\IndexProductMoveRequest;
use App\Http\Resources\ProductMoveResource;
use App\Sorters\ProductMoveSorter;

class ProductMoveController extends Controller
{
	public function index(
		IndexProductMoveRequest $request,
		ProductMoveFilter           $filter,
		ProductMoveSorter           $sorter,
		IndexProductMoveAction  $action,
	) {
		return ProductMoveResource::collection($action->handle($request, $filter, $sorter));
	}

}
