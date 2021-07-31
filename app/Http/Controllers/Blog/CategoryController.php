<?php


namespace App\Http\Controllers\Blog;


use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends BlogAbstractController
{
    public function detail(Request $request, int $category_id): View
    {
        $page = $request->get('page', 1);

        $articleService = app(ArticleService::class);

        $category = $articleService->getCategory($category_id);
        $articleGroup = $category->articles->sortByDesc('created_at')
            ->chunk(config('blog.article.article_num_per_page'));
        $articles = $articleGroup->get($page - 1, collect());

        return view('blog.category.detail', [
            'category' => $category,
            'articles' => $articles,
            'page' => $page,
            'maxPage' => $articleGroup->count(),
        ]);
    }
}
