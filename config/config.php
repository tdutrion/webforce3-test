<?php

/*
 * The default config lives here, but can be overridden in config.local.php.
 * Some values can be set as environment variable as described in the 12factor app manifest: http://12factor.net/
 */

return [

    // +---------------------------------------------------------------------------------------------------------------+
    // | Database connection details                                                                                   |
    // +---------------------------------------------------------------------------------------------------------------+

    // database host (ip, domain)
    'db_host' => getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost',

    // database username
    'db_user' => getenv('DB_USER') ? getenv('DB_USER') : 'root',

    // database password
    'db_pass' => getenv('DB_PASS') ? getenv('DB_PASS') : '',

    // database name
    'db_name' => getenv('DB_NAME') ? getenv('DB_NAME') : '',

    // database table names prefix
    'db_table_prefix' => getenv('DB_TABLE_PREFIX') ? getenv('DB_TABLE_PREFIX') : '',

    // +---------------------------------------------------------------------------------------------------------------+
    // | authentication, autorization                                                                                  |
    // +---------------------------------------------------------------------------------------------------------------+

    // name of the database table containing user details
    'security_user_table' => 'users',

    // name of the database column for the primary key
    'security_id_property' => 'id',

    // name of the database column for "username"
    'security_username_property' => 'username',

    // name of the database column for "email"
    'security_email_property' => 'email',

    // name of the database column for "password"
    'security_password_property' => 'password',

    // name of the database column for "role"
    'security_role_property' => 'role',

    // name of the route for login form
    'security_login_route_name' => 'login',
];
