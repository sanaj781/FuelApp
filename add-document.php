<div id="myModal" class="modal col-12 ">

    <!-- Modal content -->
    <div class="modal-content text-center d-flex ">
        <p class="g-0">Faktura została dodana</p>
        <button id="close" type="button" class=" btn btn-success">OK</button>

    </div>

</div>

<div id="add-doc-wraper">
    <h5 class="text-center pb-4">Dodaj Nową Fakturę</h5>
    <form id="add-invoice" class="row g-3" method="post" action="<?php add_invoice(); ?>" enctype="multipart/form-data">

        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Przebieg">
        </div>
        <div class="col-6">
            <label for="inputOddometer" class="visually-hidden">Przebieg</label>
            <input type="number" class="form-control" id="inputOddometer" name="oddometer" placeholder="np. 64325" required>
        </div>

        <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Kwota Faktury">
        </div>
        <div class="col-6">
            <label for="amount" class="visually-hidden">Kwota</label>
            <input type="number" step="any" class="form-control" id="amount" name="amount" placeholder="np. 250.43" required>
        </div>

        <div class="mb-3">
            <input class="form-control " type="file" name="image" id="fileToUpload" required>
        </div>
        <input type="hidden" id="position" name="position">
        <input type="hidden" id="isSent" name="isSent" value="<?php if (isset($_GET['status'])) echo $_GET['status'] ?>">
        <div class="col-12">
            <input type="submit" value="Upload Image" name="submit" class="col-12 btn btn-primary mb-3">
        </div>

    </form>

</div>

<!-- Getting current location -->
<script>
    window.onload = getLocation();
    const x = document.getElementById("position");

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
<!-- Showing Modal -->
<script>
    window.onload = setModal();


    function setModal() {
        const y = document.getElementById("isSent");
        if (y.value === 'success') {
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the <span> element that closes the modal
            var close = document.getElementById("close");


            modal.style.display = "flex";
            // setTimeout(function() {
            //     location.href = "index.php?page=add-document"
            // }, 5000);

            // When the user clicks on <span> (x), close the modal
            close.onclick = function() {
                modal.style.display = "none";
                location.href = "index.php?page=raport"

            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    location.href = "index.php?page=raport"

                }
            }
        }

    }
</script>
<!-- End of Showing Modal -->