<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'users', 'icon' => 'Profile', 'route' => 'users.index'],
            ['label' => 'items', 'icon' => 'Bag', 'route' => 'items.index'],
        ],
    ],
    [
        'title' => 'management',
        'items' => [
            [
                'label' => 'content',
                'icon' => 'Document',
                'children' => [
                    ['label' => 'categories', 'url' => '#'],
                    ['label' => 'collections', 'url' => '#'],
                ],
            ],
        ],
    ],
];
