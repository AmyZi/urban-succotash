<?php
add_action('rest_api_init', function() {
    register_rest_route('debug/v1', '/jwt', [
        'methods' => 'GET',
        'callback' => function() {
            return [
                'key_defined' => defined('JWT_AUTH_SECRET_KEY'),
                'key_value' => defined('JWT_AUTH_SECRET_KEY') ? substr(JWT_AUTH_SECRET_KEY, 0, 5) . '...' : 'NOT SET',
                'env_var' => getenv('JWT_AUTH_SECRET_KEY') ? 'present' : 'empty',
            ];
        },
        'permission_callback' => '__return_true',
    ]);
});
