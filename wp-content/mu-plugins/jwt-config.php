<?php
error_log('JWT KEY: ' . getenv('JWT_AUTH_SECRET_KEY'));
define('JWT_AUTH_SECRET_KEY', getenv('2af740243f843d49d6e0ef3c569586c795f66bdf9aefadc56fdb8b5d71f50b5c'));
define('JWT_AUTH_CORS_ENABLE', true);

add_filter('jwt_auth_secret_key', function() {
    return getenv('JWT_AUTH_SECRET_KEY');
});
