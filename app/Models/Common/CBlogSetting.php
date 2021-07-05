<?php

namespace App\Models\Common;

use App\Models\AbstractModel;

class CBlogSetting extends AbstractModel
{
    protected $table = 'c_blog_settings';

    const KEY_BLOG_TITLE = 'blog_title';
    const KEY_BLOG_DESCRIPTION = 'blog_description';
}
