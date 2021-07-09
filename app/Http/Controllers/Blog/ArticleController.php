<?php


namespace App\Http\Controllers\Blog;


use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends BlogAbstractController
{
    /**
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        return view('blog.article.list');
    }
}
