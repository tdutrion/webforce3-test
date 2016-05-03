<?php


return [
    [
        'GET',
        '/',
        'Frontend#index',
        'frontend_index',
    ],
    [
        'GET',
        '/admin',
        'Admin#index',
        'admin_index',
    ],
    [
        'GET',
        '/admin/import',
        'Admin#import',
        'admin_import',
    ],
    [
        'GET|POST',
        '/admin/import/process',
        'Admin#process_import',
        'admin_process_import',
    ],
    [
        'GET|POST',
        '/admin/article/[i:id]',
        'Admin#article',
        'admin_article',
    ],
];
