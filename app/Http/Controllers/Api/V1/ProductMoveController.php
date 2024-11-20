<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\ProductMove\IndexProductMoveAction;
use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductMove\IndexProductMoveRequest;
use App\Http\Resources\ProductMoveResource;
use App\Sorters\ProductSorter;

class ProductMoveController extends Controller
{
	public function index(
		IndexProductMoveRequest $request,
		ProductFilter           $filter,
		ProductSorter           $sorter,
		IndexProductMoveAction  $action,
	) {
		return ProductMoveResource::collection($action->handle($request, $filter, $sorter));
	}

}
