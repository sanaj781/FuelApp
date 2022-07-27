<?php
get_active_trips();
if (isset($_SESSION['active_trip']) && $_SESSION['active_trip'] !== 0) {

    include 'active-trip.php';
} else {
    include 'add-trip.php';
}
