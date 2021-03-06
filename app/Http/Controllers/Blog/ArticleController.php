<?php


namespace App\Http\Controllers\Blog;


use App\Exceptions\CriticalException;
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

    /**
     * @param Request $request
     * @param int $article_id
     * @return View
     * @throws CriticalException
     */
    public function detail(Request $request, int $article_id): View
    {
        $articleService = app(ArticleService::class);

        $article = $articleService->getArticle($article_id);
        if (!$articleService->canViewArticle($article_id, \Auth::user())) {
            throw new CriticalException('cannot view this article');
        }

        $previousArticle = $articleService->getPreviousArticle($article->created_at);
        $nextArticle = $articleService->getNextArticle($article->created_at);

        $bodyHtml = markdown_to_html($article->body);

        $relatedArticles = $articleService->getRelatedArticles($article_id);

        return view('blog.article.detail', [
            '_description' => $article->description,
            'article' => $article,
            'prevLink' => $this->formatNavigationLink($previousArticle),
            'nextLink' => $this->formatNavigationLink($nextArticle),
            'bodyHtml' => $bodyHtml,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
