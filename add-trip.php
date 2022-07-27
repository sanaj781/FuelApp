<?php
if (isset($_SESSION['active_trip']) && $_SESSION['active_trip'] !== 0) {
    include 'active-trip.php';
} else {
?>
    <div id="myModal" class="modal col-12 ">

        <!-- Modal content -->
        <div class="modal-content text-center d-flex ">
            <p class="g-0"><?php if (empty($_GET['error'])) {
                                if (isset($_GET['action']) && $_GET['action'] == "end-trip") {
                                    echo 'Wyjazd zakończony. Dystans ' . $_SESSION['end_ride_distance'] . ' km';
                                }
                            } else print_r($_GET['error']); ?>

            </p>
            <button id="close" type="button" class=" btn btn-success">OK</button>

        </div>

    </div>
    <h5 class="pb-4 text-center">
        Rozpocznij Wyjazd
    </h5>
    <div class="row" id="start-ride-wraper">
        <form class="col-12" method="POST" action="back-end/add_ride.php">
            <div class="form-check form-switch col-12 d-flex ">
                <input class="form-check-input col-6" type="checkbox" role="switch" id="typeOfRide" name="typeOfRide" onchange="checkTypeOfRide()">
                <label class="form-check-label col-6 ps-3" for="typeOfRide">Wyjazd Służbowy</label>
            </div>

            <div id="delegation-wrapper" class="hidden">
                <fieldset class="form-group mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="gridRadios" id="delegation" value="delegation" checked onchange="checkTypeOfDelegationRide()">
                                <label class="form-check-label" for="delegation">
                                    Delegacja
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="gridRadios" id="administration" value="administration" onchange="checkTypeOfDelegationRide()">
                                <label class="form-check-label" for="administration">
                                    Wyjazd Administracyjny
                                </label>
                            </div>

                        </div>
                    </div>
                </fieldset>
                <div class="col-12 mt-3 " id="delegationNr-wrapper">

                    <label class="col-12 col-form-label" for="delegationNr">
                        Nr Delegacji:
                    </label>
                    <select class="form-select col-12" aria-label="Default select example" id="delegationNr" name="delegationNr">
                        <option value="2343 - Gdynia">2343 - Gdynia</option>
                        <option value="2345 - Wroclaw">2345 - Wroclaw</option>
                        <option value="2343 - Mykanów">2343 - Mykanów</option>
                    </select>
                </div>
                <div class="col-12 hidden mt-3" id="administration-wrapper">
                    <label for="administration-ride" class="col-12 col-form-label"> Cel Wyjazdu Administracyjnego:</label>
                    <input type="text" class="form-control" id="administration_ride" name="administration_ride" placeholder="np. wyjazd do oddzialu w Modlinie">
                </div>
            </div>
            <div class="col-12">
                <label for="odometer_start" class="col-12 col-form-label"> Aktualny przebieg, km</label>
                <input type="number" class="form-control" id="odometer_start" name="odometer_start" placeholder="np. <?php echo $_SESSION['car_oddometer'] ?>" required>
            </div>

            <input type="hidden" id="isSent" name="isSent" value="<?php if (isset($_GET['status'])) echo $_GET['status'] ?>">

            <div class="col-12 mt-4">
                <button type="submit" name="add_ride" class="btn btn-primary col-12">Rozpocznij Wyjazd</button>

            </div>
        </form>

    </div>
<?php } ?>