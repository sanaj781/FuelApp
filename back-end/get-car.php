
<?php
//Function for getting a cars for a choosen user
function get_car()
{
    include 'db.php';
    $select = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $_SESSION['cars'] . "'");
    $row = mysqli_fetch_assoc($select);
    if (mysqli_num_rows($select)) {
        $_SESSION['car_reg_nr'] = $row['registration_nr'];
        $_SESSION['car_oddometer'] = $row['oddometer'];
        $_SESSION['car_model'] = $row['car_model'];
        $_SESSION['car_img'] = $row['car_img'];
    } else {
        header("Location: index.php?error=Wrong user or password");
    }
}
//End of function of getting a cars for a choosen user
