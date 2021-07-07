<?php

use App\Models\Common\CBlogSetting;

return [
    /**
     * Max Blog Title Length
     */
    'max_blog_title_length' => 32,

    'default_values' => [
        CBlogSetting::KEY_BLOG_TITLE => 'Blog Title',
        CBlogSetting::KEY_BLOG_DESCRIPTION => 'Blog Description',
    ],
];
