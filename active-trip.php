<?php get_active_trips();
?>
<div id="myModal" class="modal col-12 ">

    <!-- Modal content -->
    <div class="modal-content text-center d-flex ">
        <p class="g-0"><?php if (empty($_GET['error'])) echo 'Zarejestrowałes nowy wyjazd';
                        else print_r($_GET['error']); ?>

        </p>
        <button id="close" type="button" class=" btn btn-success">OK</button>

    </div>

</div>
<h5 class="pb-3 text-center">
    Status aktywnego wyjazdu</h5>
<div class="row active-ride-status ">
    <div class="border-wrapper">

        <div class="col-12 pb-1">
            Typ Wyjazdu: <?php echo $_SESSION['active_trip']['description'] ?>
        </div>
        <div class="col-12 pb-1">

            Przebieg przed rozpoczęciem: <?php echo $_SESSION['active_trip']['odometer_start'] ?>
        </div>
        <div class="col-12 pb-1">

            Samochód: <?php $indexOfCar = array_search($_SESSION['active_trip']['car'], $_SESSION['arrayOfcars']['id']);
                        $car_trip = $_SESSION['arrayOfcars']['car_model'][$indexOfCar];
                        echo $car_trip;



                        ?>
        </div>
        <div class="col-12 pb-1">

            Data i czas rozpoczęcia: <?php echo $_SESSION['active_trip']['start_date'] ?>
        </div>
    </div>
    <div class="col-12 py-3 fw-bold">
        Żeby zakończyć aktywny wyjazd wpisz aktualny przebieg i zatwierdź:
    </div>


</div>

<div class="row" id="start-ride-wraper">
    <form class="col-12" method="POST" action="back-end/end_ride.php">

        <div class="col-12">
            <input type="number" class="form-control" id="odometer_end" name="odometer_end" placeholder="np. <?php echo $_SESSION['active_trip']['odometer_start'] + 50 ?>" required>
        </div>

        <input type="hidden" id="isSent" name="isSent" value="<?php if (isset($_GET['status'])) echo $_GET['status'] ?>">

        <div class="col-12 mt-4">
            <button type="submit" name="end_ride" class="btn btn-primary col-12">Zakończ Wyjazd</button>

        </div>
    </form>

</div>