<?php
$dbServername = "localhost:8889";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "DrabpolFuelApp";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (mysqli_connect_error())
    echo "Connection Error.";
