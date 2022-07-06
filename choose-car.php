    <h5 class="pb-1 text-center pb-1">Wybierz samochód:</h5>


    <?php
    change_default_car();

    include 'back-end/db.php';
    $cars = explode(",", $_SESSION['cars']);
    foreach ($cars as $value) {
        $select_available_cars = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $value . "'");
        $row = mysqli_fetch_assoc($select_available_cars);
        if (mysqli_num_rows($select_available_cars)) {
            echo '
            <div class="row text-center align-items-center justify-content-center" id="choose-car">

            <div class="row align-items-center">
                <div class="col-3">
                <img id="car-img" src="imgs/' . $row['car_img'] . '" alt="" />
    </div>
        <div class="col-3" id="car-brand">' . $row['car_model'] . '</div>
        <div class="col-3" id="car-plates">' . $row['registration_nr'] . '</div>
       

        <div class="col-3" id="car-plates"> <a href="?page=choose-car&car=' . $row['id'] . '" class="btn btn-primary">Wybierz</a></div>

        </div>
    </div>

';
        }
    }
    ?>