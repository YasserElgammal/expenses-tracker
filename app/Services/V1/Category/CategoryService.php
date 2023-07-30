<?php

namespace App\Services\V1\Category;

use App\DataTransferObjects\V1\Category\CategoryDto;
use App\Models\V1\Category;
use Illuminate\Http\Request;

class CategoryService
{

    public function store(CategoryDto $categoryDto)
    {
        return Category::create([
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
            'type' => $categoryDto->type,
            'user_id' => $categoryDto->user_id,
            'added_source' =>  $categoryDto->added_source
        ]);
    }

    public function index(Request $request)
    {
        return Category::with('user')->where('user_id', auth()->id())->latest('created_at')
            ->paginate((int) $request->items_per_page ?: config('constants.items_per_page'));
    }

    public function show($id)
    {
        return Category::with('user')->where('user_id', auth()->id())->findOrFail($id);
    }

    public function update($id, CategoryDto $categoryDto)
    {
        $category = Category::where('user_id', auth()->id())->findOrfail($id);

        return $category->update([
                'name' => $categoryDto->name,
                'description' => $categoryDto->description,
                'type' => $categoryDto->type,
                'user_id' => $categoryDto->user_id,
                'added_source' =>  $categoryDto->added_source
            ]);
    }

    public function destroy($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrfail($id);

        return $category->delete($id);
    }

    public function listAuthUserCategory()
    {
        return auth()->user()->categories()->get();
    }
}
