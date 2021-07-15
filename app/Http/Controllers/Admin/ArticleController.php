<?php


namespace App\Http\Controllers\Admin;


use App\Models\User\UArticle;
use App\Services\ArticleService;
use DB;
use Illuminate\Http\Request;

class ArticleController extends AdminAbstractController
{
    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
    {
        $articles = app(ArticleService::class)->getArticles();

        return view('admin.article.list', [
            'articles' => $articles,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, int $article_id)
    {
        $articleService = app(ArticleService::class);

        if ($article_id) {
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function save(Request $request)
    {
        try {

            $this->validate($request, [
                'article_id' => 'required|' . ($request->article_id ? 'exists:u_articles,id' : ''),
                'title' => 'required|string',
                'category_ids' => 'array',
                'body' => 'required|string',
            ]);

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
            return redirect()->back()->withException($throwable)->withInput();
        }

        return redirect()->route('admin.article.list')->with('success', 'Saved');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        try {
            $this->validate($request, [
                'article_id' => 'required|integer|min:0'
            ]);

            DB::beginTransaction();

            app(ArticleService::class)->deleteArticle($request->article_id);

            DB::commit();
        } catch (\Exception $exception) {
            \Log::error($exception);
            DB::rollBack();
            return redirect()->back()->withException($exception);
        }

        return redirect()->route('admin.article.list')->with('success', 'Deleted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function category(Request $request)
    {
        return view('admin.article.category');
    }
}
