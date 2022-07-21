<div id="history-wraper">
    <div class="row text-center ">
        <h5 class="pb-3">Moje Faktury</h5>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Plik</th>
                <th scope="col">Data</th>
                <th scope="col">Kwota</th>
                <th scope="col">Samochód</th>

            </tr>
        </thead>
        <tbody>
            <tr>

                <?php get_invoices();
                foreach ($_SESSION['invoices'] as $value) {
                    echo '
                <td scope="row"> <a download href="uploads/' . $value['plik'] . '">
                 <i class="bi bi-file-arrow-down-fill"></i>
                 </a>
                 </td>
                <td>' . explode(" ", $value['date'])[0] . '</td>
                <td>' . $value['amount'] . '</td>
                <td>' . $value['car'] . '</td>


                </tr>';
                }
                ?>
        </tbody>
    </table>
</div>