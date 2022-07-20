<?php
session_start();
include 'functions.php';

if (!empty($_POST)) {

    if (isset($_POST['typeOfRide']) && $_POST['typeOfRide'] == 'on') {


        if (isset($_POST['gridRadios']) && $_POST['gridRadios'] == 'delegation') {
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
                header("Location: index.php?page=modal&status=success");
            } else $_SESSION['error'] = mysqli_error($conn);
        }
        if (isset($_POST['gridRadios']) && $_POST['gridRadios'] == 'administration') {
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
                header("Location: ../index.php?page=start-ride&status=success");
            } else $_SESSION['error'] = mysqli_error($conn);
        }
    } else {
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
            header("Location:../index.php?page=start-ride&status=success");
        } else $_SESSION['error'] = mysqli_error($conn);
    }
}
