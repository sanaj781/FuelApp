<div id="history-wraper">
    <div class="row text-center ">
        <h5 class="pb-3">Moje Faktury</h5>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Przebieg</th>
                <th scope="col">Kwota</th>
                <th scope="col">Samochód</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php get_invoices();
                $arr = array(1, 2, 3, 4);
                $nr = 1;
                foreach ($_SESSION['invoices'] as $value) {
                    $nr++;
                    echo '
                <th scope="row">' . $nr . '</th>
                <td>' . explode(" ", $value['date'])[0] . '</td>
                <td>' . $value['oddometer'] . '</td>
                <td>' . $value['amount'] . '</td>
                <td>' . $value['car'] . '</td>


                </tr>';
                }
                ?>
        </tbody>
    </table>
</div>