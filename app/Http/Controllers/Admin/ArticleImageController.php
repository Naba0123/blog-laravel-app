<?php


namespace App\Http\Controllers\Admin;


use App\Services\ArticleImageService;
use Illuminate\Http\JsonResponse;
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
     * Upload image (ajax)
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function uploadAjax(Request $request): JsonResponse
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);

        try {
            $filename = app(ArticleImageService::class)->saveImage(null, $request->file('file'));
        } catch (\Throwable $throwable) {
            \Log::error($throwable);
            return JsonResponse::create(['error' => $throwable->getMessage()]);
        }

        return JsonResponse::create(['filename' => $filename]);
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
