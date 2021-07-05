<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class ArticleController extends AdminAbstractController
{
    public function list(Request $request)
    {
        return $this->_view('admin.article.list');
    }

    public function category(Request $request)
    {
        return $this->_view('admin.article.category');
    }
}
