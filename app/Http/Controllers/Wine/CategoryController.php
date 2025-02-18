<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
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
        return redirect()->route('categories.index');
    }
}