<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Contracts\View\View;

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
    public function create(): View
{
    return view('wine.category.create', [
        'category' => new \App\Models\Category(),
        'action' => route('categories.store'),
        'method' => 'POST',
        'submit' => 'Create',
    ]);
}


}
