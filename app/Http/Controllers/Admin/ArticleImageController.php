<?php


namespace App\Http\Controllers\Admin;


use App\Services\ArticleImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleImageController extends AdminAbstractController
{
    /**
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $images = app(ArticleImageService::class)->getImageNames();

        return view('admin.article_image.list', [
            'images' => $images,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function upload(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);

        try {
            app(ArticleImageService::class)->saveImage($request->file('file'));
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomError(error_messages($throwable));
        }

        return redirect()->route('admin.article_image.list')->withSuccess('Media Uploaded');
    }
}
