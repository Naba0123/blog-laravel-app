<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SettingController extends AdminAbstractController
{
    public function general(Request $request)
    {
        return $this->_view('admin.dashboard.index');
    }
}
