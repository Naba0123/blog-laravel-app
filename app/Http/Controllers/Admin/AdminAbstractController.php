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

        $params['_breadcrumbs'] = $this->_breadcrumbs($request);
        $params['_currentMenu'] = last($params['_breadcrumbs']);

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

    /**
     * パンくずリストの作成
     *
     * @param Request $request
     * @return array
     */
    private function _breadcrumbs(Request $request): array
    {
        $breadcrumbs = [];

        $this->_searchBreadCrumb($request->path(), config('admin.menu.items'), $breadcrumbs);

        return $breadcrumbs;
    }

    /**
     * パンくずリスト検索
     *
     * @param string $url
     * @param array $currentMenu
     * @param array $currentBreadCrumb
     * @return bool
     */
    private function _searchBreadCrumb(string $url, array $currentMenu, array &$currentBreadCrumb): bool
    {
        $isHit = false;
        foreach ($currentMenu as $menu) {
            if (isset($menu['submenu'])) {
                $_menu = $menu;
                unset($_menu['submenu']);
                array_push($currentBreadCrumb, $_menu);
                $isHit = $this->_searchBreadCrumb($url, $menu['submenu'], $currentBreadCrumb);
                if (!$isHit) {
                    array_pop($currentBreadCrumb);
                }
            } else if (isset($menu['url']) && $url === $menu['url']) {
                array_push($currentBreadCrumb, $menu);
                $isHit = true;
            }
        }
        return $isHit;
    }
}
