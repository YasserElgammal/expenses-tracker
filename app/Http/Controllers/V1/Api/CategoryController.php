<?php

namespace App\Http\Controllers\V1\Api;

use App\DataTransferObjects\V1\Category\CategoryDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\CategoryRequest;
use App\Http\Resources\V1\Api\CategoryResource;
use App\Http\Resources\V1\Api\SimpleListResource;
use Illuminate\Http\Request;
use App\Services\V1\Category\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service
    ) {
    }

    public function index(Request $request)
    {
        $categories = $this->service->index($request);

        return $this->successReponse(data: CategoryResource::collection($categories));
    }

    public function store(CategoryRequest $request)
    {
        $this->service->store(CategoryDto::comingRequestFromApi($request));

        return $this->successReponse(message: trans('app.record_added'));
    }

    public function show($id)
    {
        $category = $this->service->show($id);

        return $this->successReponse(data: CategoryResource::make($category));
    }

    public function update($id, CategoryRequest $request)
    {
        $this->service->update($id, CategoryDto::comingRequestFromApi($request));

        return $this->successReponse(message: trans('app.record_updated'));
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return $this->successReponse(message: trans('app.record_deleted'));
    }

    public function listAuthUserCategory()
    {
        $listUserCategories = $this->service->listAuthUserCategory();

        return $this->successReponse(data: SimpleListResource::collection($listUserCategories));
    }
}
