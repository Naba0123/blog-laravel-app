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
        $rules = [];
        foreach (CBlogSetting::ENABLE_SETTING_KEYS as $key) {
            $_rule = 'required|string|';
            if ($length = config('blog.setting.max_length.' . $key)) {
                $_rule .= 'between:1,' . $length;
            } else {
                $_rule .= 'min:1';
            }
            $rules[$key] = $_rule;
        }
        $this->validate($request, $rules);

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

    /**
     * View Design Setting
     *
     * @param Request $request
     * @return View
     */
    public function design(Request $request): View
    {
        return view('admin.setting.design');
    }

    /**
     * Save Design Setting
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Throwable
     */
    public function saveDesign(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'header_image' => ['file'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $settingService = app(SettingService::class);

                if ($headerImage = $request->file('header_image')) {
                    $settingService->saveHeaderImage($headerImage);
                }
            });
        } catch (Throwable $throwable) {
            \Log::error($throwable);
            return back()->withInput()->withCustomErrors(error_messages($throwable));
        }

        return redirect()->route('admin.setting.design')->withSuccess('Saved Design Setting.');
    }
}
