<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndexController extends AdminAbstractController
{
    /**
     * Redirect
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function index(Request $request): RedirectResponse
    {
        return redirect()->route('admin.dashboard.index');
    }
}
