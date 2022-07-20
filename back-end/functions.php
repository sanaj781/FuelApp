<?php

function validate($data)
{

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;
}
//User Auth Function
function user_authentification()
{
    if (isset($_POST['submit-login'])) {
        //Check input fields
        if (isset($_POST['username']) && isset($_POST['password'])) {


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
                    $_SESSION['userinfo'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['logedin'] = 1;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['username'] = $username;
                    //Cars for choosing for curent user
                    $_SESSION['cars'] = $row['car_ids'];
                    //Default car for curent user
                    $_SESSION['default_car'] = $row['default_car_id'];
                    //Calling a function to get 
                    get_default_car();
                    get_all_cars();

                    header("Location: index.php");
                } else {
                    header("Location: index.php?error=Wrong user or password");
                }
            }
        } else {
            header("Location: index.php?error=Login or password is empty");
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
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 'raport';
        header("Location: index.php?page=" . $page);
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
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

//End of Function for switching default car for a choosen user

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



function get_all_cars()
{
    include 'back-end/db.php';
    $cars = explode(",", $_SESSION['cars']);
    foreach ($cars as $value) {
        $select_available_cars = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $value . "'");

        $row = mysqli_fetch_assoc($select_available_cars);
        if (mysqli_num_rows($select_available_cars)) {
            $_SESSION['arrayOfcars']['id'][] = $row['id'];
            $_SESSION['arrayOfcars']['reg_nr'][] = $row['registration_nr'];
            $_SESSION['arrayOfcars']['oddometer'][] = $row['oddometer'];
            $_SESSION['arrayOfcars']['car_model'][] = $row['car_model'];
            $_SESSION['arrayOfcars']['car_img'][] = $row['car_img'];
        }
    }
}
