    <div class="d-flex text-center align-items-center" id="menu">
        <a href="?page=start-ride" class="
    <?php if ($_GET['page'] === 'start-ride') echo 'active'
    ?>
     col-4 g-0">
            <div class="" id="menu-item">
                <i class="bi bi-car-front-fill"></i>
                <div>Dodaj Podróż</div>
            </div>
        </a>
        <a href="?page=add-document" class="
    <?php if ($_GET['page'] === 'add-document') echo 'active'
    ?>
    col-4 g-0">
            <div class="" id="menu-item">
                <i class="bi bi-file-plus"></i>
                <div>Dodaj Fakturę</div>
            </div>
        </a>

        <a href="?page=raport" class="
    <?php if (!isset($_GET['page']) || $_GET['page'] === 'raport') echo 'active'
    ?>
    col-4 g-0">
            <div class="" id="menu-item-last ">
                <i class="bi bi-receipt-cutoff"></i>
                <div>Raport</div>
            </div>
        </a>
    </div>
    </div>
    </body>

    </html>