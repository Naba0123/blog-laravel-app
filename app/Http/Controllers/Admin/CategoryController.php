<?php


namespace App\Http\Controllers\Admin;


use App\Services\ArticleService;
use Illuminate\Http\Request;

class CategoryController extends AdminAbstractController
{
    /**
     * カテゴリー一覧ページ
     *
     * @param Request $request
     */
    public function list(Request $request)
    {
        $categories = app(ArticleService::class)->getCategories();

        return view('admin.category.list', [
            'categories' => $categories
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed|string
     */
    public function save(Request $request)
    {
        try {
            $this->validate($request, [
                'category_id' => 'required|integer|min:0',
                'name' => 'required|string|min:0',
            ]);

            \DB::transaction(function() use ($request) {
                app(ArticleService::class)->saveCategory(
                    $request->category_id, $request->name
                );
            });
        } catch (\Throwable $throwable) {
            return json_failure($throwable);
        }

        return redirect()->route('admin.category.list')->with('success', 'Saved');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        try {
            $this->validate($request, [
                'category_id' => 'required|integer|min:0',
            ]);

            \DB::transaction(function() use ($request) {
                app(ArticleService::class)->deleteCategory($request->category_id);
            });
        } catch (\Throwable $throwable) {
            return json_failure($throwable);
        }

        return redirect()->route('admin.category.list')->with('success', 'Saved');
    }
}
