<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create()
    {
        return view('category.create');
    }

    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->createOrUpdateCategory($request);
        return redirect('categories');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepository->createOrUpdateCategory($request, $category);
        return redirect('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('categories');
    }

}
