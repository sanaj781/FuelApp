<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
} else {
    if (isset($_POST['end_ride'])) {

        if (isset($_POST['odometer_end']) && !empty($_POST['odometer_end']) && is_numeric($_POST['odometer_end'])) {
            include 'functions.php';

            if ($_POST['odometer_end'] > $_SESSION['odometer_start']) {
                $_SESSION['end_ride_distance'] =  validate($_POST['odometer_end']) - $_SESSION['odometer_start'];
                date_default_timezone_set('Europe/Warsaw');
                $date = date('Y-m-d H:i:s');
                if ($_SESSION['active_trip']['description'] == 'Wyjazd prywatny') {
                    include 'db.php';
                    $end_trip = "UPDATE private_trips SET finished=1, end_date='" . $date . "', odometer_end ='" . validate($_POST['odometer_end']) . "', distance='" . $_SESSION['end_ride_distance'] . "' WHERE id='" . $_SESSION['active_trip']['id'] . "'";

                    $result = @mysqli_query($conn, $end_trip);
                    if ($result) {
                        update_car_odometer(validate($_POST['odometer_end']));
                        get_active_trips();
                        calculate_budget();
                        header("Location:../index.php?page=start-ride&status=success&action=end-trip");
                    } else {
                        header("Location:../index.php?page=start-ride&status=error&error=Wystąpił problem. Skontaktuj się z administratorem applikacji");
                    }
                }
                if (
                    (isset($_SESSION['active_trip']['delegation_nr']) && !empty($_SESSION['active_trip']['delegation_nr'])) || (isset($_SESSION['active_trip']['additional_info']) && !empty($_SESSION['active_trip']['additional_info']))
                ) {
                    include 'db.php';
                    $end_trip = "UPDATE business_trips SET finished=1, end_date='" . $date . "', odometer_end ='" . validate($_POST['odometer_end']) . "', distance='" . $_SESSION['end_ride_distance'] . "' WHERE id='" . $_SESSION['active_trip']['id'] . "'";
                    $result = @mysqli_query($conn, $end_trip);
                    if ($result) {
                        update_car_odometer(validate($_POST['odometer_end']));
                        get_active_trips();
                        calculate_budget();
                        header("Location:../index.php?page=start-ride&status=success&action=end-trip");
                    } else {
                        header("Location:../index.php?page=start-ride&status=error&error=Wystąpił problem. Skontaktuj się z administratorem applikacji");
                    }
                }
            } else header("Location:../index.php?page=start-ride&status=error&error=Przebieg nie może być mniejszy, niż przed rozpoczęciem podróży");
        } else header("Location:../index.php?page=start-ride&status=error&error=Wpisano nieprawidlową wartość w pole przebieg");
    } else header("Location:../index.php?page=start-ride&status=error&error=Access denied");
}
