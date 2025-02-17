<?php

namespace App\Repositories\Category;

use App\Traits\CRUDOperations;
use App\Models\Category;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    use CRUDOperations;

   protected string $model = Category::class;
}
