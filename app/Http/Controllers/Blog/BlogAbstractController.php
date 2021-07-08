<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogAbstractController extends Controller
{
    /**
     * @var array Common Bind Parameter
     */
    protected array $_assignParams = [];

    public function __construct()
    {
        $request = request();
        $params = [];

        $this->_assignParams = $params;
    }

    /**
     * View
     *
     * @param string $viewPath
     * @param array $params
     * @return View
     */
    protected function _view(string $viewPath, array $params = [])
    {
        $params = array_merge($this->_assignParams, $params);
        return view($viewPath, $params);
    }
}
