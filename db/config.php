<?php
// DB config — loads from Environment Variables (server) or .env (local)
$_env = file_exists(__DIR__ . '/../.env') ? parse_ini_file(__DIR__ . '/../.env') : [];

$servname = getenv('DB_HOST')     ?: ($_env['DB_HOST'] ?? 'localhost');
$username = getenv('DB_USERNAME') ?: ($_env['DB_USERNAME'] ?? 'root');
$password = getenv('DB_PASSWORD') ?: ($_env['DB_PASSWORD'] ?? '');
$db       = getenv('DB_NAME')     ?: ($_env['DB_NAME'] ?? 'tms');

$conn = mysqli_connect($servname, $username, $password, $db);
if (!$conn) {
    exit("Connection failed: " . mysqli_connect_error());
}
?>
