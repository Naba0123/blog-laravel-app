<?php

return [
    'items' => [
        [
            'route' => 'admin.dashboard.index',
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
                    'route' => 'admin.article.list',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Category',
                    'route' => 'admin.article.category',
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
                    'route' => 'admin.dashboard.index',
                ],
            ],
        ]
    ],
];
