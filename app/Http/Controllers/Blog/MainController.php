<?php


namespace App\Http\Controllers\Blog;


use App\Services\ArticleService;
use Illuminate\Http\Request;

class MainController extends BlogAbstractController
{
    public function index(Request $request)
    {
        $articles = app(ArticleService::class)->getArticles();

        foreach ($articles as $article) {
            $article->body_html = markdown_to_html($article->body);
        }

        return view('blog.main.index', ['articles' => $articles]);
    }
}
