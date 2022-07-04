<div id="add-doc-wraper">
    <h5 class="text-center pb-4">Dodaj Nową Fakturę</h5>
    <form class="row g-3">
        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Przebieg">
        </div>
        <div class="col-6">
            <label for="inputPassword2" class="visually-hidden">Przebieg</label>
            <input type="number" class="form-control" id="inputPassword2" placeholder="64325">
        </div>

        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Kwota Faktury">
        </div>
        <div class="col-6">
            <label for="inputPassword2" class="visually-hidden">Kwota</label>
            <input type="number" class="form-control" id="inputPassword2" placeholder="np. 250,43">
        </div>

        <div class="mb-3">
            <input class="form-control " type="file" id="formFile">
        </div>
        <div class="col-12">
            <button type="submit" class=" col-12 btn btn-primary mb-3">Wyślij Fakturę</button>
        </div>
    </form>

</div>



<!-- Getting location -->
<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }
</script>
<!-- End of getting location -->