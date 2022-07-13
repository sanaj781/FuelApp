<script type="text/javascript" src="js/js.js"></script>
<script>
    window.onload = function() {
        setModal();
    }
</script>
<div id="myModal" class="modal col-12 ">

    <!-- Modal content -->
    <div class="modal-content text-center d-flex ">
        <p class="g-0">Zarejestrowałeś nowy wyjazd</p>
        <button id="close" type="button" class=" btn btn-success">OK</button>

    </div>

</div>
<div class="row text-center ">
    <h5 class="pb-3">Rozpocznij Wyjazd</h5>
</div>
<div class="row" id="start-ride-wraper">
    <form class="col-12" method="POST" action="<?php add_new_ride(); ?>">
        <div class="form-check form-switch col-12 d-flex ">
            <input class="form-check-input col-6" type="checkbox" role="switch" id="typeOfRide" name="typeOfRide" onchange="checkTypeOfRide()">
            <label class="form-check-label col-6 ps-3" for="typeOfRide">Wyjazd Służbowy</label>
        </div>

        <div id="delegation-wrapper" class="hidden">
            <fieldset class="form-group mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="delegation" value="delegation" checked onchange="checkTypeOfDelegationRide()">
                            <label class="form-check-label" for="delegation">
                                Delegacja
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="administration" value="administration" onchange="checkTypeOfDelegationRide()">
                            <label class="form-check-label" for="administration">
                                Wyjazd Administracyjny
                            </label>
                        </div>

                    </div>
                </div>
            </fieldset>
            <div class="col-12 mt-3 " id="delegationNr-wrapper">

                <label class="form-check-label" for="delegationNr">
                    Nr Delegacji:
                </label>
                <select class="form-select col-12" aria-label="Default select example" id="delegationNr" name="delegationNr">
                    <option value="2343 - Gdynia">2343 - Gdynia</option>
                    <option value="2345 - Wroclaw">2345 - Wroclaw</option>
                    <option value="2343 - Mykanów">2343 - Mykanów</option>
                </select>
            </div>
            <div class="col-12 hidden" id="administration-wrapper">
                <label for="administration-ride" class="col-sm-2 col-form-label"> Cel Wyjazdu Administracyjnego:</label>
                <input type="text" class="form-control" id="administration_ride" name="administration_ride" placeholder="np. wyjazd do oddzialu w Modlinie">
            </div>
        </div>
        <div class="col-12">
            <label for="distance" class="col-sm-2 col-form-label"> Planowany Dystans, km</label>
            <input type="number" class="form-control" id="distance" name="distance" placeholder="np. 250km" required>
        </div>

        <input type="hidden" id="isSent" name="isSent" value="<?php if (isset($_GET['status'])) echo $_GET['status'] ?>">






        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary col-12">Dodaj Wyjazd</button>

        </div>
    </form>

</div>