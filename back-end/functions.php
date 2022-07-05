<?php

//User Auth Function
function user_authentification()
{
    //Check input fields
    if (isset($_POST['username']) && isset($_POST['password'])) {

        function validate($data)
        {

            $data = trim($data);

            $data = stripslashes($data);

            $data = htmlspecialchars($data);

            return $data;
        }
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        if (empty($username)) {

            header("Location: index.php?error=User Name is required");

            exit();
        } else if (empty($password)) {

            header("Location: index.php?error=Password is required");

            exit();
        } else {
            include 'db.php';
            $select_user = mysqli_query($conn, "SELECT * FROM users WHERE login = '" . $username . "' AND password= '" . $password . "'");
            $row = mysqli_fetch_assoc($select_user);
            if (mysqli_num_rows($select_user)) {
                $_SESSION['logedin'] = 1;
                $_SESSION['name'] = $row['name'];
                $_SESSION['username'] = $username;
                $_SESSION['cars'] = $row['car_ids'];
                get_default_car();
                header("Location: index.php");
            } else {
                header("Location: index.php?error=Wrong user or password");
            }
        }
    }
}
//End of User Auth Function

//Function for getting a default car for a choosen user
function get_default_car()
{
    include 'db.php';
    $select_car = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $_SESSION['cars'] . "'");
    $row = mysqli_fetch_assoc($select_car);
    if (mysqli_num_rows($select_car)) {
        $_SESSION['car_reg_nr'] = $row['registration_nr'];
        $_SESSION['car_oddometer'] = $row['oddometer'];
        $_SESSION['car_model'] = $row['car_model'];
        $_SESSION['car_img'] = $row['car_img'];
    } else {
        header("Location: index.php?error=Wrong user or password");
    }
}
//End of Function for getting a default car for a choosen user

//Function for getting a all cars available for a choosen user
function get_cars()
{


    include 'db.php';
    $select_available_cars = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $_SESSION['cars'] . "'");
    $row = mysqli_fetch_assoc($select_available_cars);
    if (mysqli_num_rows($select_available_cars)) {
        $_SESSION['car_reg_nr'] = $row['registration_nr'];
        $_SESSION['car_oddometer'] = $row['oddometer'];
        $_SESSION['car_model'] = $row['car_model'];
        $_SESSION['car_img'] = $row['car_img'];
    } else {
        header("Location: index.php?error=Wrong user or password");
    }
}
//End of Function for getting a all cars available for a choosen user

//Function for adding new invoice into database
function add_invoice()
{
    if (isset($_POST["submit"])) {
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

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "uploads/" . $file_name);
                date_default_timezone_set('Europe/Warsaw');

                $date = date('Y-m-d H:i:s');
                include 'db.php';
                $query = "INSERT INTO Invoices (plik, user, date, oddometer, amount, location)
                            VALUES(
                            '" . $file_name . "',
                            '" . $_SESSION['username'] . "',
                             '" . $date . "',
                             '" . $_POST['oddometer'] . "',
                             '" . $_POST['amount'] . "',
                             '" . $_POST['position'] . "'



                            )";
                $result = @mysqli_query($conn, $query);
                if ($result) {
                    echo json_encode(["sent" => 1,]);
                } else echo json_encode(["sent" => 0,]);

                echo "Success";
            } else {
                echo $errors[0];
            }
        }
    }
}


    // // Check if image file is a actual image or fake image
    // if (isset($_POST["submit"])) {
    //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //     if ($check !== false) {
    //         echo "File is an image - " . $check["mime"] . ".";
    //         $uploadOk = 1;
    //     } else {
    //         echo "File is not an image.";
    //         $uploadOk = 0;
    //     }
    // }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // // Allow certain file formats
    // if (
    //     $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //     && $imageFileType != "gif"
    // ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }

    // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //     echo "Sorry, your file was not uploaded.";
    //     // if everything is ok, try to upload file
    // } else {
    //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //         $date = date('Y-m-d H:i:s');
    //         include 'db.php';
    //         $query = "INSERT INTO invoices (user, przebieg, kwotaFaktury, plik, data, geolocation, jazda_prywatna)
    //             VALUES(
    //             '" . $_POST['oddometer'] . "',
    //             '" . $_POST['amount'] . "',
    //             '" . $target_file . "',
    //             '" . $date . "',
    //             '" . $_POST['position'] . "',
    //             '" . $_POST['description'] . "',
    //             'wyslano do wyceny'
    //             )";
    //         $result = @mysqli_query($conn, $query);
    //         if ($result) {
    //             echo json_encode(["sent" => 1,]);
    //         } else echo json_encode(["sent" => 0,]);
    //         echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    //     } else {
    //         echo "Sorry, there was an error uploading your file.";
    //     }
    // }
//End of Function for adding new invoice into database
