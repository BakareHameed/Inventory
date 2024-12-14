<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'], // Define which paths should have CORS enabled
    'allowed_methods' => ['*'], // Specify allowed HTTP methods
    'allowed_origins' => ['http://localhost:8000'], // Specify allowed origins
    'allowed_headers' => ['Content-Type', 'X-Auth-Token', 'Origin', 'Authorization'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,

];
