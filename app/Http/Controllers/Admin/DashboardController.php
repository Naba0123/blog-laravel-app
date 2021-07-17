<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends AdminAbstractController
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('admin.dashboard.index');
    }
}
