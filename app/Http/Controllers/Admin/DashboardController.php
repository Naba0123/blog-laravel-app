<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends AdminAbstractController
{
    public function index(Request $request)
    {
        return view('admin.dashboard.index');
    }
}
