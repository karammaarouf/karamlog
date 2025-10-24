<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'users', 'icon' => 'Profile',
            'children'=>[

                ['label' => 'users.index', 'icon' => 'Users', 'route' => 'users.index'],
                ['label' => 'users.deleted', 'icon' => 'Delete','color'=>'red', 'route' => 'users.deleted'],

            ]],
            ['label' => 'items', 'icon' => 'Bag','children'=>[
                ['label' => 'items.index', 'icon' => 'Items', 'route' => 'items.index'],
                ['label' => 'items.deleted', 'icon' => 'Delete','color'=>'red', 'route' => 'items.deleted'],
            ]],
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
