<?php
session_start();

if (isset($_POST['add_ride'])) {
    include 'functions.php';

    if (isset($_POST['distance']) && is_numeric($_POST['distance'])) {

        if (isset($_POST['typeOfRide']) && validate($_POST['typeOfRide']) == 'on') {


            if (isset($_POST['gridRadios']) && validate($_POST['gridRadios']) == 'delegation') {
                if (!empty($_POST['delegationNr'])) {

                    include 'db.php';
                    date_default_timezone_set('Europe/Warsaw');
                    $date = date('Y-m-d H:i:s');
                    $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, distance, delegation_nr, car, date)
                    VALUES(
                    '" . $_SESSION['username'] . "',
                    '" . validate($_POST['typeOfRide']) . "',
                    '" . validate($_POST['gridRadios']) . "',
                    '" . validate($_POST['distance']) . "',
                    '" . validate($_POST['delegationNr']) . "',
                    '" . $_SESSION['default_car'] . "',
                    '" . $date . "'
                    )";
                    $result = @mysqli_query($conn, $query);
                    if ($result) {
                        calculate_budget();
                        header("Location:../index.php?page=start-ride&status=success");
                    } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
                } else {
                    header("Location:../index.php?page=start-ride&status=error&error=Nie wybrales nr Delegacji");
                }
            } else if (isset($_POST['gridRadios']) && validate($_POST['gridRadios']) == 'administration') {
                if (!empty($_POST['administration_ride'])) {
                    include 'db.php';
                    date_default_timezone_set('Europe/Warsaw');
                    $date = date('Y-m-d H:i:s');
                    $query = "INSERT INTO business_trips (user, business_or_private, delegation_or_administration, distance, additional_info, car, date)
                    VALUES(
                    '" . $_SESSION['username'] . "',
                    '" . validate($_POST['typeOfRide']) . "',
                    '" . validate($_POST['gridRadios']) . "',
                    '" . validate($_POST['distance']) . "',
                    '" . validate($_POST['administration_ride']) . "',
                    '" . $_SESSION['default_car'] . "',
                    '" . $date . "'
                    )";
                    $result = @mysqli_query($conn, $query);
                    if ($result) {
                        calculate_budget();
                        header("Location: ../index.php?page=start-ride&status=success");
                    } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
                } else header("Location:../index.php?page=start-ride&status=error&error=Nie wpisales cel wyjazdu administracyjnego");
            }
        } else if (validate($_POST['typeOfRide']) !== 'on') {
            include 'db.php';

            date_default_timezone_set('Europe/Warsaw');
            $date = date('Y-m-d H:i:s');
            $query = "INSERT INTO private_trips (user, distance, car, date)
                VALUES(
                '" . $_SESSION['username'] . "',
                '" . validate($_POST['distance']) . "',
                '" . $_SESSION['default_car'] . "',
                '" . $date . "'
                )";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                calculate_budget();
                header("Location:../index.php?page=start-ride&status=success");
            } else header("Location:../index.php?page=start-ride&status=error&error=Wystapil problem. Skontaktuj sie z administrtorem applikacji");
        }
    } else header("Location:../index.php?page=start-ride&status=error&error=Wpisz prawidlowa zawartosc w Planowany dystans : np. 250 ");
} else {
    header("Location:../index.php?page=start-ride&status=error&error=Brak uprawnien");
}
