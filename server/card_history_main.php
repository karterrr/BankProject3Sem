<?php
session_start();

require_once "config.php";
require_once "utils.php";
$datacheck = array(
    'number' => $array[$i]->number,
    'token' => $_SESSION['id'],
    'pageNumber' => $_GET['page'],
    'pageSize' =>10
);

$responseDatacheck = api_call($api_url."/history/card", "POST", $datacheck);

if ($responseDatacheck->success === TRUE) {
    $arraycheck = $responseDatacheck->data->data;
    $j = 0;
    while ($j < count($arraycheck)) {
        if ($j < 11) {
?>
            <tr class="col3">
                <?php
                if($arraycheck[$j]->count>0)
                {
                ?>
                <td>Пополнение карты</td>
                <?php
                }
                elseif($arraycheck[$j]->type==0)
                {
                ?>
                <td>Перевод на карту: <?= substr($arraycheck[$j]->dest, 0, 4), "****", substr($arraycheck[$j]->dest, 12, 15) ?> </td>
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
                <td>Оплата услуг: <?=$arraycheck[$j]->dest?> </td>
                <?php
                }
                ?>
                <td><?php echo substr($arraycheck[$j]->date, 0, 10)," ",substr($arraycheck[$j]->date, 11, 8) ?></td>
                <td><?= $arraycheck[$j]->count, " руб." ?></td>
            </tr>
<?php
            $j = $j + 1;
        } else {
            break;
        }
    }
}
?>