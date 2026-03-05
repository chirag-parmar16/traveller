<?php
// config.php — loads API keys from Environment Variables (server) or .env (local)
$_env = file_exists(__DIR__ . '/.env') ? parse_ini_file(__DIR__ . '/.env') : [];

define('UNSPLASH_API_KEY',    getenv('UNSPLASH_API_KEY')    ?: ($_env['UNSPLASH_API_KEY'] ?? ''));
define('GOOGLE_MAPS_API_KEY', getenv('GOOGLE_MAPS_API_KEY') ?: ($_env['GOOGLE_MAPS_API_KEY'] ?? ''));
?>