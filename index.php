<?php
include 'header.php';

if (
    isset($_GET['page']) && $_SESSION['logedin'] === 1 && isset($_SESSION['username'])
    && isset($_SESSION['car_reg_nr']) && $_SESSION['userinfo'] === $_SERVER['HTTP_USER_AGENT']

) {
    $pageurl = validate($_GET['page']);

    if (!empty($pageurl)) {
        if (is_file($pageurl . '.php')) {
            include($pageurl . '.php');
            include 'footer.php';
        } else {
            echo 'Page does not exist';
            include 'footer.php';
        }
    }
} else {

    include 'main-page.php';
    include 'footer.php';
}
