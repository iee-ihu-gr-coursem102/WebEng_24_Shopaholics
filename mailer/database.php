<?php

$host = "localhost";
$dbname = "shopaholics";
$username = "meladma";
$password = "!8pmM$@tz";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
