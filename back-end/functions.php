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