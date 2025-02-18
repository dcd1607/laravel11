<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        return view('wine.category.index', [
            'categories' => $this->repository->paginate(
                counts: ['wines']
            )
        ]);
    }
    public function create(): View{
        return view('wine.category.create', [
            'category' => new \App\Models\Category(),
            'action' => route('categories.store'),
            'method' => 'POST',
            'submit' => 'Create',
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse{
        $this->repository->create($request->validated());
        session()->flash('success', 'Categoria creada correctamente');
        return redirect()->route('categories.index');
    }

    public function edit(Category $category): View{
        return view('wine.category.edit', [
            'category' => $category,
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'submit' => 'Actualizar',
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse{
        $this->repository->update($request->validated(), $category);
        session()->flash('success', 'Categoria actualizada correctamente');
        return redirect()->route('categories.index');
    }
}