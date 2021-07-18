<?php

return [
    'items' => [
        [
            'url' => 'admin/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'text' => 'Dashboard',
        ],
        [
            'icon' => 'far fa-circle',
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
            'icon' => 'far fa-circle',
            'text' => 'Category',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Category',
                    'url' => 'admin/category/list',
                ],
            ]
        ],
        [
            'icon' => 'far fa-circle',
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
            'icon' => 'far fa-circle',
            'text' => 'Setting',
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'General Setting',
                    'url' => 'admin/setting/general',
                ],
            ],
        ]
    ],
];
