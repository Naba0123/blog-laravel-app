<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends AdminAbstractController
{
    public function index(Request $request)
    {
        return $this->_view('admin.dashboard.index');
    }
}
