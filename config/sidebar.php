<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'users', 'icon' => 'Profile',
            'children'=>[
                ['label' => 'Users List', 'icon' => 'Users', 'route' => 'users.index'],
                ['label' => 'Deleted Users', 'icon' => 'Delete','color'=>'red', 'route' => 'users.deleted'],
            ]],
            ['label' => 'roles', 'icon' => 'Shield',
            'children'=>[
                ['label' => 'Roles List', 'icon' => 'Users', 'route' => 'roles.index'],
            ]],
            ['label' => 'items', 'icon' => 'Bag','children'=>[
                ['label' => 'Items List', 'icon' => 'Items', 'route' => 'items.index'],
                ['label' => 'Deleted Items', 'icon' => 'Delete','color'=>'red', 'route' => 'items.deleted'],
            ]],
        ],
    ],
    [
        'title' => 'management',
        'items' => [
                    ['label' => 'content',
                'icon' => 'Document',
                'children' => [
                    ['label' => 'categories', 'icon' => 'Document', 'route' => 'categories.index'],
                    ['label' => 'collections', 'url' => '#'],
                ],
            ],
        ],
    ],
];
