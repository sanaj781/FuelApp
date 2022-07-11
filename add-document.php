<div id="add-doc-wraper">
    <h5 class="text-center pb-4">Dodaj Nową Fakturę</h5>
    <form class="row g-3" method="post" action="<?php add_invoice(); ?>" enctype="multipart/form-data">

        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Przebieg">
        </div>
        <div class="col-6">
            <label for="inputOddometer" class="visually-hidden">Przebieg</label>
            <input type="number" class="form-control" id="inputOddometer" name="oddometer" placeholder="64325">
        </div>

        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Kwota Faktury">
        </div>
        <div class="col-6">
            <label for="amount" class="visually-hidden">Kwota</label>
            <input type="number" step="any" class="form-control" id="amount" name="amount" placeholder="np. 250.43">
        </div>

        <div class="mb-3">
            <input class="form-control " type="file" name="image" id="fileToUpload">
        </div>
        <input type="hidden" id="position" name="position">
        <div class="col-12">
            <input type="submit" value="Upload Image" name="submit" class="col-12 btn btn-primary mb-3">
        </div>

    </form>

</div>

<!-- Getting location -->
<script>
    window.onload = getLocation();
    var x = document.getElementById("position");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.value = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.value = position.coords.latitude +
            " " + position.coords.longitude;
    }
</script>
<!-- End of getting location -->