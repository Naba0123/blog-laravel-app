<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends AdminAbstractController
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.auth.index');
    }

    /**
     * @inheritdoc
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.dashboard.index');
    }
}
