<?php

use App\Models\Common\CBlogSetting;

return [
    /**
     * Max Length
     */
    'max_length' => [
        CBlogSetting::KEY_BLOG_TITLE => 32,
        CBlogSetting::KEY_BLOG_DESCRIPTION => 64,
        CBlogSetting::KEY_AUTHOR_NAME => 32,
        CBlogSetting::KEY_AUTHOR_DESCRIPTION => 256,
        CBlogSetting::KEY_TWITTER_SITE_SCREEN_NAME => 32,
        CBlogSetting::KEY_TWITTER_CREATOR_SCREEN_NAME => 32,
    ],

    /**
     * Default Setting Values
     */
    'default_values' => [
        CBlogSetting::KEY_BLOG_TITLE => 'Blog Title',
        CBlogSetting::KEY_BLOG_DESCRIPTION => 'Blog Description',
        CBlogSetting::KEY_AUTHOR_NAME => 'Author Name',
        CBlogSetting::KEY_AUTHOR_DESCRIPTION => 'Author Description',
    ],
];
