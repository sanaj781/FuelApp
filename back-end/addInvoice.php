<?php
include 'db.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}




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
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO invoices (user, przebieg, kwotaFaktury, plik, data, geolocation, jazda_prywatna)
VALUES(
'" . $_POST['oddometer'] . "',
'" . $_POST['amount'] . "',
'" . $target_file . "',
'" . $date . "',
'" . $_POST['position'] . "',
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
