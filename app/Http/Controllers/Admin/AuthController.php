<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after auth.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function index(Request $request)
    {
        return view('admin.auth.index');
    }
}
