<?php
<<<<<<< HEAD
return [
    'paths' => ['api/*', 'admin/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://127.0.0.1:3000'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], 
=======

return [
    'paths' => ['admin/*', 'sanctum/csrf-cookie', 'login', 'logout'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [env('ADMIN_FRONTEND_URL', 'http://localhost:3000')],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
>>>>>>> master
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
