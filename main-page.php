<?php
//If user is loged in show the main page content
if (
  isset($_SESSION['logedin']) && $_SESSION['logedin'] === 1 && isset($_SESSION['username'])
  && isset($_SESSION['car_reg_nr']) && $_SESSION['userinfo'] === $_SERVER['HTTP_USER_AGENT']
) {
  if (isset($_SESSION['active_trip']) && $_SESSION['active_trip'] !== 0) {
    include 'start-ride.php';
  } else {
    include 'raport.php';
  }
  include 'footer.php';
}
//If user is not loged in show the login page
else {
  include 'login-page.php';
}
