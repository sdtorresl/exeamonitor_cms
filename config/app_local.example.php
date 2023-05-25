<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '__SALT__'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => env('MYSQL_HOST', 'localhost'),
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',

            'username' => env('MYSQL_USER', 'my_app'),
            'password' => env('MYSQL_PASSWORD', 'secret'),
            'database' => env('MYSQL_DATABASE', 'my_app'),

            /**
             * If not using the default 'public' schema with the PostgreSQL driver
             * set it here.
             */
            //'schema' => 'myapp',

            /**
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
        ],

        /*
         * Debug kit
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * Each transport needs a `className`. Valid options are as follows:
     *
     * Mail   - Send using PHP mail function
     * Smtp   - Send using SMTP
     * Debug  - Do not send the email, just return the result
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'className' => '',
            'host' => env('SMTP_HOST', 'localhost'),
            'port' => env('SMTP_PORT', 25),
            'username' => env('SMTP_LOGIN', null),
            'password' => env('SMTP_SECRET', null),
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],

    'Cache' => [
        'short' => [
            'className' => 'Redis',
            'host' => 'exeamonitor-cache',
            'duration' => '+30 seconds',
            'prefix' => 'exeamonitor_',
        ],
        'long' => [
            'className' => 'Redis',
            'host' => 'exeamonitor-cache',
            'duration' => '+10 minutes',
            'prefix' => 'exeamonitor_',
        ],
    ],

    'Pusher' => [
        'appKey' => env('PUSHER_KEY'),
        'appSecret' =>  env('PUSHER_SECRET'),
        'appId' =>  env('PUSHER_APP_ID'),
        'cluster' =>  env('PUSHER_CLUSTER'),
    ],
    'Ampache' => [
        'host' => env('AMPACHE_HOST', 'https://ampache.exeamedia.com'),
        'user' => env('AMPACHE_USER', 'exeadmin'),
        'pass' => env('AMPACHE_PASS', '3x34Media2023'),
        'port' => env('AMPACHE_PORT', '80'),
    ]
];
