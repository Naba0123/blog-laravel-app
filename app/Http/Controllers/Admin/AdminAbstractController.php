<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAbstractController extends Controller
{
    /**
     * AdminAbstractController constructor.
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
        $params = [];

        $params['_breadcrumbs'] = $this->_breadcrumbs($request);
        $params['_currentMenu'] = last($params['_breadcrumbs']);
        $params['_sessionExceptionType'] =
            config('admin.session.error_class.' . session('exception'),
                config('admin.session.error_class.default', 'danger')
            );

        foreach ($params as $key => $value) {
            \View::share($key, $value);
        }
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
