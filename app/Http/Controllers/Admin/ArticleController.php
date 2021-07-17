<?php


namespace App\Http\Controllers\Admin;


use App\Models\User\UArticle;
use App\Services\ArticleService;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ArticleController extends AdminAbstractController
{
    /**
     * View of article list
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $articles = app(ArticleService::class)->getArticles();

        return view('admin.article.list', [
            'articles' => $articles,
        ]);
    }

    /**
     * View of editing article
     *
     * @param Request $request
     * @param int $article_id
     * @return View
     */
    public function edit(Request $request, int $article_id): View
    {
        $articleService = app(ArticleService::class);

        if ($article_id > 0) {
            $article = $articleService->getArticle($article_id);
        } else {
            $article = new UArticle();
        }

        $categories = $articleService->getCategories();
        $associatedCategoryIds = $article->categories->pluck('id')->all();

        return view('admin.article.edit', [
            'article' => $article,
            'categories' => $categories,
            'associatedCategoryIds' => $associatedCategoryIds,
        ]);
    }

    /**
     * Save article
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function save(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'article_id' => 'required|' . ($request->article_id > 0 ? 'exists:u_articles,id' : ''),
            'title' => 'required|string',
            'category_ids' => 'array',
            'body' => 'required|string',
        ]);

        try {
            \DB::transaction(function() use ($request) {
                app(ArticleService::class)->saveArticle(
                    $request->article_id,
                    $request->title,
                    $request->category_ids ?: [],
                    $request->body,
                );
            });
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.article.list')->withSuccess('Saved Article');
    }

    /**
     * Delete article
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function delete(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'article_id' => 'required|exists:u_articles,id',
        ]);
        try {
            DB::transaction(function() use ($request) {
                app(ArticleService::class)->deleteArticle($request->article_id);
            });
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return back()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.article.list')->withSuccess('Deleted Article');
    }

}
