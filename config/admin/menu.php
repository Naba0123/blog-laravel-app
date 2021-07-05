<?php

return [
    'items' => [
        [
            'route' => 'admin.index',
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
                    'route' => 'admin.index',
                ],
            ],
        ]
    ],
];
