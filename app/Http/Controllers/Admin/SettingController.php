<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\CBlogSetting;
use App\Services\SettingService;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class SettingController extends AdminAbstractController
{
    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function general(Request $request)
    {
        return view('admin.setting.general');
    }

    /**
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
        ]);

        try {
            DB::transaction(function () use ($request) {
                app(SettingService::class)->saveSetting($request->all());
            });

            return redirect()->route('admin.setting.general')->withSuccess('Saved General Setting.');
        } catch (Throwable $throwable) {
            return back()->withCustomErrors(error_messages($throwable))->withInput();
        }
    }
}
