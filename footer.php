    <div class="d-flex text-center align-items-center" id="menu">
        <a href="?page=start-ride" class="
    <?php if ($_GET['page'] === 'start-ride') echo 'active_menu'
    ?>
     col-4 g-0">
            <div class="" id="menu-item">
                <i class="bi bi-car-front-fill"></i>
                <div>Dodaj Podróż</div>
            </div>
        </a>
        <a href="?page=add-document" class="
    <?php if ($_GET['page'] === 'add-document') echo 'active_menu'
    ?>
    col-4 g-0">
            <div class="" id="menu-item">
                <i class="bi bi-file-plus"></i>
                <div>Dodaj Fakturę</div>
            </div>
        </a>

        <a href="?page=raport" class="
    <?php if (!isset($_GET['page']) || $_GET['page'] === 'raport') echo 'active_menu'
    ?>
    col-4 g-0">
            <div class="" id="menu-item-last">
                <i class="bi bi-receipt-cutoff"></i>
                <div>Raport</div>
            </div>
        </a>
    </div>
    </div>
    <script>
        const inputs = ['amount', 'inputOddometer', 'fileToUpload', 'distance', 'administration_ride'];
        for (let i = 0; i < inputs.length; i++) {
            $("#" + inputs[i]).focus(
                function() {
                    $('html, body').animate({
                        scrollTop: ($("#" + inputs[i]).offset().top - 10)
                    }, 100);
                    return false;
                    console.log('sds');
                });

        }


        window.onload = function() {
            SwipeCar();
            setModal();

        }
    </script>


    </body>

    </html>