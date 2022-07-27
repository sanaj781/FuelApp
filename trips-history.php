<div id="history-wraper">
    <div class="row text-center ">
        <h5 class="pb-3">Wyjazdy Służbowe</h5>
    </div>
    <table id="rides" class="table text-center col-12">
        <thead>
            <tr>
                <th scope="col">Cel</th>
                <th scope="col">Data</th>
                <th scope="col">Dystans</th>
                <th scope="col">Samochód</th>

            </tr>
        </thead>
        <tbody>
            <tr>

                <?php get_trips();
                foreach ($_SESSION['business_trips'] as $value) {

                    if ($value['delegation_or_administration'] == 'delegation') {
                        $type = 'DEL';
                    } else $type = "ADM";
                    $index = array_search($value['car'], $_SESSION['arrayOfcars']['id']);
                    $car = $_SESSION['arrayOfcars']['car_model'][$index];
                    echo '
                <td scope="row"> 
                '
                        . $type . '
                 </td>
                <td>' . explode(" ", $value['start_date'])[0] . '</td>
                <td>' . $value['distance'] . '</td>
                <td>' . $car . '</td>


                </tr>';
                }
                ?>
        </tbody>
    </table>
</div>