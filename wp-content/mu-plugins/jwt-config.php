<?php
define('JWT_AUTH_SECRET_KEY', $_ENV['JWT_AUTH_SECRET_KEY'] ?? $_SERVER['JWT_AUTH_SECRET_KEY'] ?? '');
define('JWT_AUTH_CORS_ENABLE', true);
add_filter('jwt_auth_secret_key', function() {
    return $_ENV['JWT_AUTH_SECRET_KEY'] ?? $_SERVER['JWT_AUTH_SECRET_KEY'] ?? '';
});
