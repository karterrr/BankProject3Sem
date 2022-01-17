<?php
session_start();

require "config.php";
require "utils.php";

$datacheck = array(
    'number' => $array[$i]->number,
    'token' => $_SESSION['id'],
    'operationCount' => 10
);

$responseDatacheck = api_call($api_url."/history/check", "POST", $datacheck);

if ($responseDatacheck->success === TRUE) {
    $arraycheck = $responseDatacheck->data;
    $j = 0;
    while ($j < count($arraycheck)) {
        if ($j < 11) {
?>
            <tr class="col3">
                <?php
                if($arraycheck[$j]->type==0)
                {
                ?>
                <td>Перевод на карту</td>
                <?php
                }
                elseif($arraycheck[$j]->type==1)
                {
                ?>
                <td>Перевод на счёт</td>
                <?php
                }
                else
                {
                ?>
                <td>Оплата услуг</td>
                <?php
                }
                ?>
                <td><?php echo substr($arraycheck[$j]->date, 0, 10)," ",substr($arraycheck[$j]->date, 11, 8) ?></td>
                <td><?= $arraycheck[$j]->count ?></td>
            </tr>
<?php
            $j = $j + 1;
        } else {
            break;
        }
    }
}
?>