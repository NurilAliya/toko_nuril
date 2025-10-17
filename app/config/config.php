<?php
// Set timezone to WIB (Western Indonesia Time)
date_default_timezone_set('Asia/Jakarta');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'toko_nuril');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Base URL Configuration
define('BASE_URL', 'http://localhost/toko_nuril/');

// Security Configuration
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_NAME', 'toko_nuril_session');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/error.log');
?>