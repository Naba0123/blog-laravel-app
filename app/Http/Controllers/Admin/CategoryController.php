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
    public function saveAjax(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|integer|min:0',
                'name' => 'required|string|min:0',
            ]);
        } catch (\Throwable $exception) {
            return admin_ajax_failure();
        }

        return redirect()->route('admin.category.list')->with('success', 'Saved');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAjax(Request $request)
    {
        try {
            $this->validate($request, [

            ]);
        } catch (\Throwable $exception) {
            return redirect()->back()->withException($exception);
        }

        return redirect()->route('admin.category.list')->with('success', 'Saved');
    }
}
