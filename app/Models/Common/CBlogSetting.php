<?php

namespace App\Models\Common;

use App\Models\AbstractModel;

class CBlogSetting extends AbstractModel
{
    protected $table = 'c_blog_settings';

    const KEY_BLOG_TITLE = 'blog_title';
    const KEY_BLOG_DESCRIPTION = 'blog_description';

    /**
     * 有効な設定キー
     */
    const ENABLE_SETTING_KEYS = [
        self::KEY_BLOG_TITLE,
        self::KEY_BLOG_DESCRIPTION,
    ];
}
