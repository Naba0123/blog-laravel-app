<?php


namespace App\Http\Controllers\Blog;


use Illuminate\Http\Request;

class MainController extends BlogAbstractController
{
    public function index(Request $request)
    {
        return $this->_view('blog.main.index');
    }
}
