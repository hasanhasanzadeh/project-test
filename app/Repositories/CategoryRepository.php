<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Category;


class CategoryRepository
{
    public function findById($id)
    {
        return Category::find($id);
    }

    public function getAllCategories($perPage = 10,$search=null)
    {
        $categories = Category::query();
        if($search){
            $categories = $categories->where('name', 'LIKE', "%{$search}%");
        }
        return $categories->sortable()->paginate($perPage);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function deleteCategory($id): int
    {
        return Category::destroy($id);
    }

    public function updateCategory(array $data,$id)
    {
        $category = Category::find($id)->update($data);
        if (isset($data['avatar'])) {
            if ($category->photo) {
                Helper::deleteFile($category->photo->url);
                $category->photo()->delete();
            }
            $path = str_replace('public', 'storage', $data['avatar']->store('public/avatars'));
            $category->photo()->create(['path' => $path]);
        }
        return $category->fresh();
    }
}
