<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
} else {
    if (isset($_POST['add_ride'])) {
        if (isset($_SESSION['active_trip']) && $_SESSION['active_trip'] !== 0) {
            header("Location:../index.php?page=start-ride&status=error&error=Masz niezakończony wyjazd");
        }

        if (isset($_POST['odometer_start']) && is_numeric($_POST['odometer_start'])) {
            if ($_POST['odometer_start'] < $_SESSION['car_oddometer']) {
                header("Location:../index.php?page=start-ride&status=error&error=Aktualny przebieg jest mniejszy niż ostatnio zadeklarowany dla wybranego samochodu");
            } else {
                include 'functions.php';
                date_default_timezone_set('Europe/Warsaw');
                $date = date('Y-m-d H:i:s');

                if (isset($_POST['typeOfRide']) && validate($_POST['typeOfRide']) == 'on') {
                    if (isset($_POST['gridRadios']) && validate($_POST['gridRadios']) == 'delegation') {
                        if (!empty($_POST['delegationNr'])) {
                            include 'db.php';

                            $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, odometer_start, odometer_end, distance, delegation_nr, car, start_date, end_date, finished)
                                VALUES(
                                '" . $_SESSION['username'] . "',
                                '" . validate($_POST['typeOfRide']) . "',
                                '" . validate($_POST['gridRadios']) . "',
                                '" . validate($_POST['odometer_start']) . "',
                                0,
                                0,
                                '" . validate($_POST['delegationNr']) . "',
                                '" . $_SESSION['default_car'] . "',
                                '" . $date . "',
                                0,
                                0
                                )";
                            $result = @mysqli_query($conn, $query);
                            if ($result) {
                                $_SESSION['odometer_start'] = validate($_POST['odometer_start']);
                                get_active_trips();
                                calculate_budget();
                                header("Location:../index.php?page=start-ride&status=success");
                            } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
                        } else {
                            header("Location:../index.php?page=start-ride&status=error&error=Nie wybrales nr Delegacji");
                        }
                    } else if (isset($_POST['gridRadios']) && validate($_POST['gridRadios']) == 'administration') {
                        if (!empty($_POST['administration_ride'])) {
                            include 'db.php';
                            $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, odometer_start, odometer_end, distance, additional_info, car, start_date, end_date, finished)
                                VALUES(
                                '" . $_SESSION['username'] . "',
                                '" . validate($_POST['typeOfRide']) . "',
                                '" . validate($_POST['gridRadios']) . "',
                                '" . validate($_POST['odometer_start']) . "',
                                0,
                                0,
                                '" . validate($_POST['administration_ride']) . "',
                                '" . $_SESSION['default_car'] . "',
                                '" . $date . "',
                                0,
                                0
                                )";
                            $result = @mysqli_query($conn, $query);
                            if ($result) {
                                $_SESSION['odometer_start'] = validate($_POST['odometer_start']);
                                get_active_trips();
                                calculate_budget();
                                header("Location: ../index.php?page=start-ride&status=success");
                            } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
                        } else header("Location:../index.php?page=start-ride&status=error&error=Nie wpisales cel wyjazdu administracyjnego");
                    }
                } else if (validate($_POST['typeOfRide']) !== 'on') {
                    include 'db.php';
                    $query = "INSERT INTO private_trips (user, odometer_start, odometer_end, distance, car, start_date, end_date, finished)
                        VALUES(
                        '" . $_SESSION['username'] . "',
                        '" . validate($_POST['odometer_start']) . "',
                        0,
                        0,
                        '" . $_SESSION['default_car'] . "',
                        '" . $date . "',
                        0,
                        0
                        )";
                    $result = @mysqli_query($conn, $query);
                    if ($result) {
                        $_SESSION['odometer_start'] = validate($_POST['odometer_start']);
                        get_active_trips();
                        calculate_budget();
                        header("Location:../index.php?page=start-ride&status=success");
                    } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
                }
            }
        } else header("Location:../index.php?page=start-ride&status=error&error=Wpisz prawidlowa zawartosc w Planowany dystans : np. 250 ");
    } else {
        header("Location:../index.php?page=start-ride&status=error&error=Brak uprawnien");
    }
}
