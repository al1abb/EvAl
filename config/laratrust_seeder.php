<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        // 'superadministrator' => [
        //     'users' => 'c,r,u,d',
        //     'payments' => 'c,r,u,d',
        //     'profile' => 'r,u'
        // ],
        'administrator' => [
            'users' => 'c',
            'post' => 'c, r, u, d',
            'flag' => 'r,d'
        ],
        'moderator' => [
            'flag' => 'r, u, d',
        ],
        'user' => [
            'flag' => 'c,r'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
