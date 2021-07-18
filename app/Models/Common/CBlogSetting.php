<?php

namespace App\Models\Common;

use App\Models\AbstractModel;

class CBlogSetting extends AbstractModel
{
    protected $table = 'c_blog_settings';

    const KEY_BLOG_TITLE = 'blog_title';
    const KEY_BLOG_DESCRIPTION = 'blog_description';
    const KEY_AUTHOR_NAME = 'author_name';
    const KEY_AUTHOR_DESCRIPTION = 'author_description';
    const KEY_TWITTER_SITE_SCREEN_NAME = 'twitter_site_screen_name';
    const KEY_TWITTER_CREATOR_SCREEN_NAME = 'twitter_creator_screen_name';

    /**
     * 有効な設定キー
     */
    const ENABLE_SETTING_KEYS = [
        self::KEY_BLOG_TITLE,
        self::KEY_BLOG_DESCRIPTION,
        self::KEY_AUTHOR_NAME,
        self::KEY_AUTHOR_DESCRIPTION,
        self::KEY_TWITTER_SITE_SCREEN_NAME,
        self::KEY_TWITTER_CREATOR_SCREEN_NAME,
    ];
}
