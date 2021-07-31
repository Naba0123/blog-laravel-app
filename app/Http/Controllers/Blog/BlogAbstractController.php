<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Services\ArticleService;

class BlogAbstractController extends Controller
{

    /**
     * BlogAbstractController constructor.
     */
    public function __construct()
    {
        $this->_assignViewShareVariable();
    }

    /**
     * ビュー共通変数の設定
     */
    protected function _assignViewShareVariable()
    {
        $request = request();
        $articleService = app(ArticleService::class);

        $params = [
            'categories' => $articleService->getCategories()->sortBy('name')
        ];

        foreach ($params as $key => $value) {
            \View::share($key, $value);
        }
    }
}
