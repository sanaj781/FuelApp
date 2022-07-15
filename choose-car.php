<div id="choose-car-wraper">

    <h5 class="pb-3 text-center ">Wybierz samochód</h5>

    <?php
    change_default_car();

    include 'back-end/db.php';
    $cars = explode(",", $_SESSION['cars']);
    foreach ($cars as $value) {
        $select_available_cars = mysqli_query($conn, "SELECT * FROM cars WHERE id = '" . $value . "'");
        $row = mysqli_fetch_assoc($select_available_cars);
        if (mysqli_num_rows($select_available_cars)) {
            echo '
            <a href="?page=choose-car&car=' . $row['id'] . '" >
            <div class=" my-2 row text-center align-items-center justify-content-center" >
                <div class="d-flex align-items-center">
                    <div class="col-4">
                    <img class="" id="car-img" src="imgs/' . $row['car_img'] . '" alt="" />
                 </div>
                    <div class="col-4" id="car-brand">' . $row['car_model'] . '</div>
                    <div class="col-4" id="car-plates">' . $row['registration_nr'] . '</div>
       

                    <div class="col-4" id="car-plates"></div>

            </div>
            </div>
            </a> 

';
        }
    }
    ?>
</div>