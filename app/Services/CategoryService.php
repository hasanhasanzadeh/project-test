<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

readonly class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function getAllCategories($perPage,array $search=null)
    {
        return $this->categoryRepository->all($perPage,$search);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(array $data,$id)
    {
        return $this->categoryRepository->update($data,$id);
    }

    public function deleteCategory($id): int
    {
        return $this->categoryRepository->delete($id);
    }
}
