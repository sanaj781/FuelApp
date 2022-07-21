<?php
session_start();
if (isset($_POST['add_document'])) {
    include 'functions.php';
    if (isset($_FILES['image']) && !empty($_POST['oddometer']) && is_numeric($_POST['oddometer']) && !empty($_POST['amount']) && is_numeric($_POST['amount'])) {
        if (!empty($_POST['position'])) {
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
                if (move_uploaded_file($file_tmp, "../uploads/" . $file_name)) {
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
                        calculate_budget();

                        header("Location:../index.php?page=add-document&status=success");
                    } else header("Location:../index.php?page=add-document&status=error");
                } else {
                    header("Location:../index.php?page=add-document&status=error&error=" . $_FILES["image"]["error"] . "");
                }
            } else {
                header("Location:../index.php?page=add-document&status=error&error=" . $errors[0] . "");
            }
        } else header("Location:../index.php?page=add-document&status=error&error=Uslugi Lokalizacji wylaczone na urzadzeniu. Zeby korzystac z aplikacji wlazc uslugi lokalizacji");
    } else header("Location:../index.php?page=add-document&status=error&error=Uzupelnij wszystkie pola: Przebieg, kwota faktury, plik faktury");
} else {
    echo "Brak uprawnien";
    header("Location:../index.php?page=add-document&status=error&error=brak uprawnien");
}
