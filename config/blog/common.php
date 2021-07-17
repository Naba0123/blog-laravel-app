<?php

use App\Models\Common\CBlogSetting;

return [
    /**
     * Max Blog Title Length
     */
    'max_blog_title_length' => 32,

    /**
     * Max Blog Description Length
     */
    'max_blog_description_length' => 64,

    /**
     * Max Author Name Length
     */
    'max_author_name_length' => 32,

    /**
     * Max Author Description Length
     */
    'max_author_description_length' => 256,

    'default_values' => [
        CBlogSetting::KEY_BLOG_TITLE => 'Blog Title',
        CBlogSetting::KEY_BLOG_DESCRIPTION => 'Blog Description',
    ],
];
