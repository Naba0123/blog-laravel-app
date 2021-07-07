<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\CBlogSetting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends AdminAbstractController
{
    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function general(Request $request)
    {
        return $this->_view('admin.setting.general');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function saveGeneral(Request $request)
    {
        try {
            $this->validate($request, [
                CBlogSetting::KEY_BLOG_TITLE => 'required|string|between:1,' . config('blog.common.max_blog_title_length'),
            ]);

            \DB::beginTransaction();

            app(SettingService::class)->saveSetting($request->all());

            \DB::commit();
        } catch (\Throwable $throwable) {
            \DB::rollBack();
            return redirect()->back()->withException($throwable);
        }

        return redirect()->route('admin.setting.general')->with('success', 'Saved General Setting.');
    }
}
