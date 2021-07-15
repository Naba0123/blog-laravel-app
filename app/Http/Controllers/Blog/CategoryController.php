<?php


namespace App\Http\Controllers\Blog;


use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends BlogAbstractController
{
    public function detail(Request $request, int $category_id): View
    {
        $articleService = app(ArticleService::class);

        $category = $articleService->getCategory($category_id);

        return view('blog.category.detail', [
            'category' => $category,
        ]);
    }
}
