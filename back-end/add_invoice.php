<?php
session_start();
include 'functions.php';
if (isset($_FILES['image'])) {
    $errors = array();
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $file_name = $_FILES['image'][0] . uniqid() . '.' . $file_ext;
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size >= 20971520 || $file_size == 0) {
        $errors[] = 'File size must be less than 20 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        date_default_timezone_set('Europe/Warsaw');

        $date = date('Y-m-d H:i:s');
        include 'db.php';
        $query = "INSERT INTO Invoices (plik, user, date, oddometer, amount, location, car)
VALUES(
'" . $file_name . "',
'" . $_SESSION['username'] . "',
'" . $date . "',
'" . validate($_POST['oddometer']) . "',
'" . validate($_POST['amount']) . "',
'" . validate($_POST['position']) . "',
'" . validate($_SESSION['car_reg_nr']) . "'

)";
        $result = @mysqli_query($conn, $query);
        if ($result) {
            header("Location:../index.php?page=add-document&status=success");
        } else header("Location:../index.php?page=add-document&status=error");
    } else {
        header("Location:../index.php?page=add-document&status=error&error=" . $errors[0] . "");

        echo $errors[0];
    }
}
