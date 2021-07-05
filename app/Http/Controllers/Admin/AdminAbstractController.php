<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAbstractController extends Controller
{
    /**
     * @var array Common Bind Parameter
     */
    protected array $_assignParams = [];

    public function __construct()
    {
        $request = request();
        $this->_assignParams['_common'] = $this->_common($request);
        $this->_assignParams['_breadcrumbs'] = $this->_breadcrumbs($request);
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

    private function _common(Request $request): array
    {
        $common = [];

        return $common;
    }

    /**
     * パンくずリストの作成
     *
     * @param Request $request
     * @return array
     */
    private function _breadcrumbs(Request $request): array
    {
        $breadcrumbs = [];

        return $breadcrumbs;
    }
}
