<?php

namespace App\Observers;

use App\Models\AbstractModel;

class ModelObserver
{
    /**
     * @param AbstractModel $row
     */
    public function saved(AbstractModel $row)
    {
        // インスタンス更新時にキャッシュ削除
        $row::clearCacheData();
    }
}
