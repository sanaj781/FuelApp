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
                //Cars for choosing for curent user
                $_SESSION['cars'] = $row['car_ids'];
                //Default car for curent user
                $_SESSION['default_car'] = $row['default_car_id'];
                //Calling a function to get 
                get_default_car();
                header("Location: index.php");
            } else {
                header("Location: index.php?error=Wrong user or password");
            }
        }
    }
}
//End of User Auth Function

//Function for getting default car parameters for curent user- regNr, oddometer, carModel, carImg and storing in $_SESSION variable
function get_default_car()
{
    include 'db.php';
    $select_car = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $_SESSION['default_car'] . "'");
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
//End of Function for getting default car parameters for curent user

//Function for switching default car for a choosen user
function change_default_car()
{

    if (isset($_GET['car'])) {
        include 'db.php';
        $change_car = "UPDATE users SET default_car_id='" . $_GET['car'] . "' WHERE login='" . $_SESSION['username'] . "'";
        if (mysqli_query($conn, $change_car)) {
            $_SESSION['default_car'] = $_GET['car'];
            get_default_car();
            header("Location: index.php?page=choose-car");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

//End of Function for switching default car for a choosen user

//Function for adding new invoice into database
function add_invoice()
{

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
            $query = "INSERT INTO Invoices (plik, user, date, oddometer, amount, location, car)
                            VALUES(
                            '" . $file_name . "',
                            '" . $_SESSION['username'] . "',
                            '" . $date . "',
                            '" . $_POST['oddometer'] . "',
                            '" . $_POST['amount'] . "',
                            '" . $_POST['position'] . "',
                            '" . $_SESSION['car_reg_nr'] . "'

                            )";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                header("Location: index.php?page=add-document&status=success");
            } else header("Location: index.php?page=add-document&status=error");
        } else {
            echo $errors[0];
        }
    }
}
//End of Function for adding new invoice into database

//Function for getting history of invoices
function get_invoices()
{
    require 'db.php';
    $invoices = [];
    $sql = "SELECT * FROM Invoices WHERE user = '" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $invoices[] = $row;
        }
    }
    $_SESSION['invoices'] = $invoices;
}
// End Of Function for getting history of invoices

//Function for adding new trip/ride to a database
function add_new_ride()
{
    if (!empty($_POST)) {

        if (isset($_POST['typeOfRide']) && $_POST['typeOfRide'] == 'on') {


            if (isset($_POST['gridRadios']) && $_POST['gridRadios'] == 'delegation') {
                include 'db.php';

                date_default_timezone_set('Europe/Warsaw');
                $date = date('Y-m-d H:i:s');
                $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, distance, delegation_nr, car, date)
                            VALUES(
                            '" . $_SESSION['username'] . "',
                            '" . $_POST['typeOfRide'] . "',
                            '" . $_POST['gridRadios'] . "',
                            '" . $_POST['distance'] . "',
                            '" . $_POST['delegationNr'] . "',
                            '" . $_SESSION['default_car'] . "',
                            '" . $date . "'
                            )";
                $result = @mysqli_query($conn, $query);
                if ($result) {
                    header("Location: index.php?page=start-ride&status=success");
                } else $_SESSION['error'] = mysqli_error($conn);
            }
            if (isset($_POST['gridRadios']) && $_POST['gridRadios'] == 'administration') {
                include 'db.php';

                date_default_timezone_set('Europe/Warsaw');
                $date = date('Y-m-d H:i:s');
                $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, distance, additional_info, car, date)
                            VALUES(
                            '" . $_SESSION['username'] . "',
                            '" . $_POST['typeOfRide'] . "',
                            '" . $_POST['gridRadios'] . "',
                            '" . $_POST['distance'] . "',
                            '" . $_POST['administration_ride'] . "',
                            '" . $_SESSION['default_car'] . "',
                            '" . $date . "'
                            )";
                $result = @mysqli_query($conn, $query);
                if ($result) {
                    header("Location: index.php?page=start-ride&status=success");
                } else $_SESSION['error'] = mysqli_error($conn);
            }
        }

        if ($_POST['typeOfRide'] !== 'on') {
            include 'db.php';

            date_default_timezone_set('Europe/Warsaw');
            $date = date('Y-m-d H:i:s');
            $query = "INSERT INTO private_trips (user, distance, car, date)
                            VALUES(
                            '" . $_SESSION['username'] . "',
                            '" . $_POST['distance'] . "',
                            '" . $_SESSION['default_car'] . "',
                            '" . $date . "'
                            )";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                header("Location: index.php?page=start-ride&status=success");
            } else $_SESSION['error'] = mysqli_error($conn);
        }
    }
}
//End of Function for adding new trip/ride to a database