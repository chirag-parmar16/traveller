<?php
// DB config — loads credentials from .env (never commit .env to git)
$_env = parse_ini_file(__DIR__ . '/../.env');

$servname = $_env['DB_HOST'];
$username = $_env['DB_USERNAME'];
$password = $_env['DB_PASSWORD'];
$db       = $_env['DB_NAME'];

$conn = mysqli_connect($servname, $username, $password, $db);
if ($conn) {
    // echo "Connected";
} else {
    mysqli_connect_error();
}
