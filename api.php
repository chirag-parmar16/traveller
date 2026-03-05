<?php
// config.php — loads API keys from .env (never commit .env to git)
$_env = parse_ini_file(__DIR__ . '/.env');
define('UNSPLASH_API_KEY',    $_env['UNSPLASH_API_KEY']);
define('GOOGLE_MAPS_API_KEY', $_env['GOOGLE_MAPS_API_KEY']);
?>