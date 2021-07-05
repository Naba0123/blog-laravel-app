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
                    'icon' => 'far fa-circle',
                    'text' => 'Category',
                    'url' => 'admin/category/list',
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
