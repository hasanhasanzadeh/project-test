<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function find($id)
    {
        return Category::find($id);
    }

    public function all($search=null)
    {
        $categories = Category::query();
        if(isset($search['search'])){
            $categories = $categories->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $categories->sortable()->paginate(10);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function delete($id): int
    {
        return Category::destroy($id);
    }

    public function update(array $data,$id)
    {
        $category = Category::find($id)->update($data);
        if (isset($data['photo'])) {
            if ($category->photo) {
                Helper::deleteFile($category->photo->url);
                $category->photo()->delete();
            }
            $path = str_replace('public', 'storage', $data['photo']->store('public/avatars'));
            $category->photo()->create(['path' => $path]);
        }
        return $category;
    }
}
