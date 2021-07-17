<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\CBlogSetting;
use App\Services\SettingService;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class SettingController extends AdminAbstractController
{
    /**
     * View General Setting
     *
     * @param Request $request
     * @return View
     */
    public function general(Request $request): View
    {
        return view('admin.setting.general');
    }

    /**
     * Save General Setting
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Throwable
     */
    public function saveGeneral(Request $request): RedirectResponse
    {
        $this->validate($request, [
            CBlogSetting::KEY_BLOG_TITLE => 'required|string|between:1,' . config('blog.common.max_blog_title_length'),
            CBlogSetting::KEY_BLOG_DESCRIPTION => 'required|string|between:1,' . config('blog.common.max_blog_description_length'),
            CBlogSetting::KEY_AUTHOR_NAME => 'required|string|between:1,' . config('blog.common.max_author_name_length'),
            CBlogSetting::KEY_AUTHOR_DESCRIPTION => 'required|string|between:1,' . config('blog.common.max_author_description_length'),
        ]);

        try {
            DB::transaction(function () use ($request) {
                app(SettingService::class)->saveSetting($request->all());
            });
        } catch (Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.setting.general')->withSuccess('Saved General Setting.');
    }
}
