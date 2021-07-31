<?php


namespace App\Http\Controllers\Blog;


use App\Services\ArticleService;
use Illuminate\Http\Request;

class MainController extends BlogAbstractController
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $articleGroup = app(ArticleService::class)->getArticles()
            ->sortByDesc('created_at')
            ->chunk(config('blog.article.article_num_per_page'));

        $articles = $articleGroup->get($page - 1, collect());

        return view('blog.main.index', [
            'articles' => $articles,
            'page' => $page,
            'maxPage' => $articleGroup->count(),
        ]);
    }
}
