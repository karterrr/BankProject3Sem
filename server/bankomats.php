<?php
session_start();

require_once "config.php";
require_once "utils.php";

$responseData = api_call($api_url."/bankomats", "GET", "");

// Print the date from the response
$date = $responseData->date;

$array = $responseData;

$i = 0;
while ($i < count($array)) {
?>
    <tbody class="card_info">
        <tr>
            <td align="left" colspan="2"><?= $array[$i]->adress ?></td>

        </tr>
        <tr>
            <td align="left" class="col2_main"><?php if ($array[$i]->is_atm) {
                                                    echo "Банкомат:   ";
                                                } else {
                                                    echo "Отделение:   ";
                                                }
                                                if ($array[$i]->is_working) { ?> <p1 style="color: green;">Работает</p1> <?php } else {
                                                                                                                            ?> <p1 style="color: red;">Не работает</p1> <?php
                                                                                                                        } ?></td>
            <td class="col2_main"><?php echo "Часы работы:  ", substr($array[$i]->time_start, 0, 5), "-", substr($array[$i]->time_end, 0, 5) ?></td>
        </tr>
    </tbody>
<?php

    $i = $i + 1;
}
?>