<?php


namespace App\Http\Controllers\Blog;


use App\Http\ViewTrait\ArticleTrait;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends BlogAbstractController
{
    use ArticleTrait;

    /**
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        return view('blog.article.list');
    }

    public function detail(Request $request, int $article_id): View
    {
        $articleService = app(ArticleService::class);

        $article = $articleService->getArticle($article_id);
        $previousArticle = $articleService->getPreviousArticle($article_id);
        $nextArticle = $articleService->getNextArticle($article_id);

        $bodyHtml = markdown_to_html($article->body);

        return view('blog.article.detail', [
            '_description' => $article->description,
            'article' => $article,
            'prevLink' => $this->formatNavigationLink($previousArticle),
            'nextLink' => $this->formatNavigationLink($nextArticle),
            'bodyHtml' => $bodyHtml,
        ]);
    }
}
