<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function getAllCategories($perPage,array $search=null)
    {
        return $this->categoryRepository->getAllCategories($perPage,$search);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory(array $data,$id)
    {
        return $this->categoryRepository->updateCategory($data,$id);
    }

    public function deleteCategory($id): int
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
