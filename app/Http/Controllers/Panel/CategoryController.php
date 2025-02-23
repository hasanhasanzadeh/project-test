<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Category\CategoryCreateFormRequest;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryFindRequest;
use App\Http\Requests\Category\CategoryUpdateFormRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    public function __construct(readonly private CategoryService $categoryService){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAllRequest $categoryAllRequest): Application|Factory|View
    {
        $categories = $this->categoryService->getAllCategories($categoryAllRequest->validated());
        $title = ' دسته ها';
        return view('panel.category.index', [
            'categories' => $categories,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryCreateFormRequest $categoryCreateFormRequest): View|Factory|Application
    {
        $title = 'ایجاد دسته جدید';
        return view('panel.category.create', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $categoryCreateRequest): RedirectResponse
    {
        $this->categoryService->createCategory($categoryCreateRequest->validated());
        toast('اطلاعات با موفقیت ایجاد شد', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryFindRequest $categoryFindRequest, Category $category): Application|Factory|View
    {
        $category = $this->categoryService->getCategoryById($category->id);
        $title = $category->name;
        return view('panel.category.show', [
            'category' => $category,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryUpdateFormRequest $categoryUpdateFormRequest, Category $category): Application|Factory|View
    {
        $category = $this->categoryService->getCategoryById($category->id);
        $title = $category->name;
        return view('panel.category.edit', [
            'category' => $category,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $categoryUpdateRequest, Category $category): RedirectResponse
    {
        $this->categoryService->updateCategory($categoryUpdateRequest->validated(),$category);
        toast('اطلاعات با موفقیت بروزرسانی شد', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryDeleteRequest $categoryDeleteRequest, Category $category): RedirectResponse
    {
        $this->categoryService->deleteCategory($category->id);
        toast('اطلاعات با موفقیت حذف شد', 'success');
        return redirect()->route('categories.index');
    }
}
