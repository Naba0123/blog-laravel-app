<?php

return [
    'items' => [
        [
            'route' => 'admin.dashboard.index',
            'icon' => 'fas fa-tachometer-alt',
            'text' => 'Dashboard',
        ],
        [
//            'icon' => '',
            'text' => 'Setting',
            'submenu' => [
                [
//                    'icon' => '',
                    'text' => 'General',
                    'route' => 'admin.dashboard.index',
                ],
            ],
        ]
    ],
];
