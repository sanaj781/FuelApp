<?php
include_once 'header.php';

if (isset($_GET['page']) && $_SESSION['logedin'] === 1) {
    $pageurl = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
    if (!empty($pageurl)) {
        if (is_file($pageurl . '.php')) {
            include($pageurl . '.php');
        } else {
            echo 'Page does not exist';
        }
    }
} else {
    include 'main-page.php';
}
include 'footer.php';
