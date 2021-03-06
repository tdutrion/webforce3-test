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
        'GET',
        '/admin/article/[i:id]',
        'Admin#article',
        'admin_article',
    ],
    [
        'GET|POST',
        '/admin/article/search',
        'Admin#search',
        'admin_search',
    ],
    [
        'GET',
        '/api/article',
        'Api#collection',
        'api_collection',
    ],
];
