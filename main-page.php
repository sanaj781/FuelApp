<?php
//If user is loged in show the main page content
if ($_SESSION['logedin'] === 1) {
  include 'raport.php';
}
//If user is not loged in show the login page
else {
  include 'login-page.php';
}
