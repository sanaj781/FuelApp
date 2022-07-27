<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
} else {
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
                        if (!empty($row['budget'])) {
                            $_SESSION['budget'] = $row['budget'];
                        } else $_SESSION['budget'] = 0;
                        //Calling a function to get 
                        get_all_cars();
                        get_default_car();
                        calculate_budget();
                        get_active_trips();

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
        } else {
            header("Location:../index.php?error=Default car was not found");
        }
    }
    //End of Function for getting default car parameters for curent user

    //Function for switching default car for a choosen user
    function change_default_car()
    {

        if (isset($_GET['car'])) {
            if (in_array(validate($_GET['car']), $_SESSION['arrayOfcars']['id'])) {

                include 'db.php';
                $change_car = "UPDATE users SET default_car_id='" . validate($_GET['car']) . "' WHERE login='" . $_SESSION['username'] . "'";
                if (mysqli_query($conn, $change_car)) {
                    $_SESSION['default_car'] = $_GET['car'];
                    get_default_car();
                    if (isset($_GET['page']) && !empty($_GET['page'])) {
                        $page = validate($_GET['page']);
                    } else $page = 'raport';
                    header("Location: index.php?page=" . $page);
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            } else {
                header("Location:index.php?page=raport&error=You are not allowed to choose this car");
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

    //Function for getting history of trips
    function get_trips()
    {
        require 'db.php';
        $trips = [];
        $sql = "SELECT * FROM business_trips WHERE user = '" . $_SESSION['username'] . "' AND finished=1";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $trips[] = $row;
            }
        }
        $_SESSION['business_trips'] = $trips;

        $private_trips = [];
        $sql = "SELECT * FROM private_trips WHERE user = '" . $_SESSION['username'] . "'AND finished=1";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $private_trips[] = $row;
            }
        }
        $_SESSION['private_trips'] = $private_trips;
    }
    // End Of Function for getting history of trips
    //geting all available cars for current users
    function get_all_cars()
    {
        if (!empty($_SESSION['arrayOfcars']['id'])) {
            $_SESSION['arrayOfcars']['id'] = [];
            $_SESSION['arrayOfcars']['reg_nr'] = [];
            $_SESSION['arrayOfcars']['oddometer'] = [];
            $_SESSION['arrayOfcars']['car_model'] = [];
            $_SESSION['arrayOfcars']['car_img'] = [];
        }
        include 'db.php';
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

    function calculate_budget()
    {
        $_SESSION['business_current_month_distance'] = [];
        $_SESSION['private_current_month_distance'] = [];
        $_SESSION['invoices_current_month_expenses'] = [];
        unset($_SESSION['invoices']);
        unset($_SESSION['business_trips']);
        unset($_SESSION['private_trips']);
        get_invoices();
        get_trips();
        //calculating all inboices for current month
        foreach ($_SESSION['invoices'] as $value) {
            if (date("Y/m/", strtotime($value['date'])) >= date("Y/m/")) {
                $_SESSION['invoices_current_month_expenses'][] = $value['amount'];
            }
        }
        if (!empty($_SESSION['invoices_current_month_expenses'])) {
            $_SESSION['current_expences'] = array_sum($_SESSION['invoices_current_month_expenses']);
        } else $_SESSION['current_expences'] = 0;
        if ($_SESSION['current_expences'] == 0) {
            $_SESSION['percentage'] = 100;
        } else {
            if ($_SESSION['current_expences'] !== 0 && $_SESSION['current_expences'] < $_SESSION['budget']) {
                $_SESSION['percentage'] = round(100 - $_SESSION['current_expences'] / $_SESSION['budget'] * 100);
            } else {
                $_SESSION['percentage'] = 0;
            }
        }
        foreach ($_SESSION['business_trips'] as $value) {

            if (date("Y/m/", strtotime($value['date'])) <= date("Y/m/")) {
                $_SESSION['business_current_month_distance'][] = $value['distance'];
            }
        }
        foreach ($_SESSION['private_trips'] as $value) {
            if (date("Y/m/", strtotime($value['date'])) <= date("Y/m/")) {
                $_SESSION['private_current_month_distance'][] = $value['distance'];
            }
        }
        if (!empty($_SESSION['business_current_month_distance']) || !empty($_SESSION['private_current_month_distance'])) {
            $_SESSION['current_distance'] = array_sum($_SESSION['business_current_month_distance']) + array_sum($_SESSION['private_current_month_distance']);
        } else $_SESSION['current_distance'] = 0;
        if (!empty($_SESSION['private_current_month_distance'])) {
            $_SESSION['current_private_distance'] = array_sum($_SESSION['private_current_month_distance']);
        } else $_SESSION['current_private_distance'] = 0;
    }
}

//Function for getting active trips
function get_active_trips()
{
    require 'db.php';
    $sql = "SELECT * FROM private_trips WHERE user = '" . $_SESSION['username'] . "' AND finished=0";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['active_trip'] = $row;
            $_SESSION['odometer_start'] = $row['odometer_start'];
            $_SESSION['active_trip']['description'] = 'Wyjazd prywatny';
        }
    } else {
        $sql = "SELECT * FROM business_trips WHERE user = '" . $_SESSION['username'] . "' AND finished=0";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['odometer_start'] = $row['odometer_start'];
                $_SESSION['active_trip'] = $row;
                if ($_SESSION['active_trip']['delegation_or_administration'] == 'delegation') {
                    $_SESSION['active_trip']['description'] = 'Delegacja nr ' . $row['delegation_nr'];
                }
                if ($_SESSION['active_trip']['delegation_or_administration'] == 'administration') {
                    $_SESSION['active_trip']['description'] = 'Wyjazd administracyjny - ' . $row['additional_info'];
                }
            }
        } else {
            $_SESSION['active_trip'] = 0;
        }
    }
}
// End Of Function for getting active trips
//Update car oddometer value when trip is end
function update_car_odometer($oddometer_value)
{
    include 'db.php';
    $update_car = "UPDATE cars SET oddometer='" . $oddometer_value . "' WHERE id='" . $_SESSION['active_trip']['car'] . "'";
    if (mysqli_query($conn, $update_car)) {
        get_all_cars();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
