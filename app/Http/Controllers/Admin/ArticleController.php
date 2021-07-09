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
    public function edit(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $article = app(ArticleService::class)->getArticle($id);
        } else {
            $article = new UArticle();
        }

        return view('admin.article.edit', [
            'article' => $article,
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
                'id' => 'integer|min:0',
                'title' => 'required|string',
                'body' => 'required|string',
            ]);

            DB::beginTransaction();

            app(ArticleService::class)->saveArticle(
                $request->id,
                $request->title,
                $request->body
            );

            DB::commit();
        } catch (\Exception $exception) {
            \Log::error($exception);
            DB::rollBack();
            return redirect()->back()->withException($exception);
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
                'id' => 'required|integer|min:0'
            ]);

            DB::beginTransaction();

            app(ArticleService::class)->deleteArticle($request->id);

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
