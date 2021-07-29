<?php


namespace App\Http\Controllers\Blog;


use App\Services\ArticleService;
use Illuminate\Http\Request;

class MainController extends BlogAbstractController
{
    public function index(Request $request)
    {
        $articles = app(ArticleService::class)->getArticles()->sortByDesc('created_at');

        return view('blog.main.index', ['articles' => $articles]);
    }
}
