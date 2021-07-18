<?php


namespace App\Http\Controllers\Admin;


use App\Services\ArticleImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ArticleImageController extends AdminAbstractController
{
    /**
     * View of image list
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $images = app(ArticleImageService::class)->getAllImages();

        return view('admin.article_image.list', [
            'images' => $images,
        ]);
    }

    /**
     * Upload image
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function upload(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'filename' => 'string|min:1',
            'file' => 'required|file',
        ]);

        try {
            app(ArticleImageService::class)->saveImage($request->filename, $request->file('file'));
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomError(error_messages($throwable));
        }

        return redirect()->route('admin.article_image.list')->withSuccess('Image Uploaded');
    }

    /**
     * Delete image
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function delete(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'filename' => 'required|string'
        ]);

        try {
            app(ArticleImageService::class)->deleteImage($request->filename);
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomError(error_messages($throwable));
        }

        return redirect()->route('admin.article_image.list')->withSuccess('Image Deleted');
    }
}
