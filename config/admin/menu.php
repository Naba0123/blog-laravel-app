<?php

return [
    'items' => [
        [
            'url' => 'admin/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'text' => 'Dashboard',
        ],
        [
            'icon' => 'far fa-newspaper',
            'text' => 'Article',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Article List',
                    'url' => 'admin/article/list',
                ],
                [
                    'is_hidden' => true,
                    'text' => 'Article Edit',
                    'url' => 'admin/article/edit',
                ],
            ]
        ],
        [
            'icon' => 'fas fa-tags',
            'text' => 'Category',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Category List',
                    'url' => 'admin/category/list',
                ],
            ]
        ],
        [
            'icon' => 'far fa-images',
            'text' => 'Article Image',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Article Image List',
                    'url' => 'admin/article_image/list',
                ],
            ]
        ],
        [
            'icon' => 'fas fa-cog',
            'text' => 'Setting',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'General Setting',
                    'url' => 'admin/setting/general',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'User Setting',
                    'url' => 'admin/setting/user',
                ],
            ],
        ]
    ],
];
