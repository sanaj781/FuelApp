<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
} else {
    $dbServername = "localhost:8889";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName = "DrabpolFuelApp";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    if (mysqli_connect_error())
        echo "Connection Error.";
}
