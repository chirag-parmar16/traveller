<?php 
// DB config — loads credentials from .env
$_env = parse_ini_file(__DIR__ . '/../../.env');

define('DB_HOST', $_env['DB_HOST']);
define('DB_USER', $_env['DB_USERNAME']);
define('DB_PASS', $_env['DB_PASSWORD']);
define('DB_NAME', $_env['DB_NAME']);
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