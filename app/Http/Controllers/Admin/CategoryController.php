<?php


namespace App\Http\Controllers\Admin;


use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends AdminAbstractController
{
    /**
     * View of category list
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $categories = app(ArticleService::class)->getCategories();

        return view('admin.category.list', [
            'categories' => $categories
        ]);
    }


    /**
     * Save Category
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function save(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'category_id' => 'required|integer|min:0',
            'name' => 'required|string|min:0',
        ]);

        try {
            \DB::transaction(function() use ($request) {
                app(ArticleService::class)->saveCategory(
                    $request->category_id, $request->name
                );
            });
        } catch (\Throwable $throwable) {
            return back()->withInput()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.category.list')->withSuccess('Saved Category');
    }

    /**
     * Delete Category
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function delete(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'category_id' => 'required|integer|min:0',
        ]);

        try {
            \DB::transaction(function() use ($request) {
                app(ArticleService::class)->deleteCategory($request->category_id);
            });
        } catch (\Throwable $throwable) {
            return back()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.category.list')->withSuccess('Deleted Category');
    }
}
