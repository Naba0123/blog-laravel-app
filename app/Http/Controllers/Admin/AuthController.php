<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends AdminAbstractController
{
    use AuthenticatesUsers;

    /**
     * View of Authentication
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
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
