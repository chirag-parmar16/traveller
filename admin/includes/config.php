<?php
// DB config — loads from Environment Variables (server) or .env (local)
$_env = file_exists(__DIR__ . '/../../.env') ? parse_ini_file(__DIR__ . '/../../.env') : [];

define('DB_HOST', getenv('DB_HOST')     ?: ($_env['DB_HOST'] ?? 'localhost'));
define('DB_USER', getenv('DB_USERNAME') ?: ($_env['DB_USERNAME'] ?? 'root'));
define('DB_PASS', getenv('DB_PASSWORD') ?: ($_env['DB_PASSWORD'] ?? ''));
define('DB_NAME', getenv('DB_NAME')     ?: ($_env['DB_NAME'] ?? 'tms'));
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>