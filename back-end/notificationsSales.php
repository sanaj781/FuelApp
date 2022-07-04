<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
require 'db.php';
$notifications = 0;
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
$sql = "SELECT * FROM calculation_requests WHERE status='wyceniono' AND ordering_person='" . $_POST['username'] . "'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notifications++;
    }
}
echo json_encode(["notifications" => $notifications,]);
