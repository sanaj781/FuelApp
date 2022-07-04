<?php
$_SESSION['logedin'] = 0;
$_SESSION = array();
session_destroy();
header("Location: index.php");
