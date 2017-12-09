<?php

return [
    'database' => [
        'name' => 'crm',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'code_url' => 'App\Code\Modules'
];

