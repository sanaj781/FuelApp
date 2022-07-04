<?php
include 'checkAuth.php';
if ($auth === 1) {
    include 'db.php';
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);
    //loading file onto server
    $target_dir = "uploads/";
    $file = explode(";base64,", $_POST['projectFile']);
    $fileType = $_POST['fileExt'];
    $decodedFile = base64_decode($file[1]);
    $path = $target_dir . uniqid() . '.' . $_POST['fileExt'];
    file_put_contents($path,  $decodedFile);

    $query = "INSERT INTO calculation_requests (project_title, ordering_person, project_file, material, color, project_description, status)
VALUES(
'" . $_POST['projectName'] . "',
'" . $_POST['fullname'] . "',
'" . $path . "',
'" . $_POST['choosenMaterial'] . "',
'" . $_POST['materialColor'] . "',
'" . $_POST['description'] . "',
'wyslano do wyceny'
)";
    if ($_POST['projectName'] && $_POST['choosenMaterial'] && $_POST['materialColor'] && $_POST['description'] && $path) $result = @mysqli_query($conn, $query);
    if ($result) {
        echo json_encode(["sent" => 1,]);
    } else echo json_encode(["sent" => 0,]);
} else {
    echo json_encode(["error_message" => "Brak uprawnien",]);
}
