<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'profile', 'icon' => 'Profile', 'route' => 'profile.index'],
            [
                'label' => 'users',
                'icon' => 'Profile',
                'permissions' => ['view-users'],
                'children' => [
                    ['label' => 'Users List', 'route' => 'users.index', 'permission' => 'view-users'],
                    ['label' => 'Deleted Users', 'color' => 'red', 'route' => 'users.deleted', 'permission' => 'view-users'],
                ]
            ],
            [
                'label' => 'roles',
                'icon' => 'Shield',
                'permissions' => ['view-roles'],
                'children' => [
                    ['label' => 'Roles List', 'route' => 'roles.index', 'permission' => 'view-roles'],
                ]
            ],
            [
                'label' => 'Categories',
                'icon' => 'Category',
                'permissions' => ['view-categories'],
                'children' => [
                    ['label' => 'Categories List', 'route' => 'categories.index', 'permission' => 'view-categories'],
                    ['label' => 'Deleted Categories', 'color' => 'red', 'route' => 'categories.deleted', 'permission' => 'view-categories'],
                ]
            ],
            [
                'label' => 'Groups',
                'icon' => 'Folder',
                'permissions' => ['view-groups'],
                'children' => [
                    ['label' => 'Groups List', 'route' => 'groups.index', 'permission' => 'view-groups'],
                    ['label' => 'Deleted Groups', 'color' => 'red', 'route' => 'groups.deleted', 'permission' => 'view-groups'],
                ]
            ],
            ['label' => 'items', 'icon' => 'Bag', 'permissions' => ['view-items'], 'children' => [
                ['label' => 'Items List', 'route' => 'items.index', 'permission' => 'view-items'],
                ['label' => 'Deleted Items', 'color' => 'red', 'route' => 'items.deleted', 'permission' => 'view-items'],
            ]],
        ],
    ],
    [
        'title' => 'Settings',
        'items' => [
            ['label' => 'Customize Appearance', 'icon' => 'Setting', 'route' => 'settings.index'],
        ],
    ],
];
