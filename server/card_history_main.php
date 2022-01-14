<?php
session_start();

require "config.php";

$urlcheck = "http://lightfire.duckdns.org/history/card";

$datacheck = array(
    'number' => $array[$i]->number,
    'token' => $_SESSION['id'],
    'operationCount' => 10
);

$optionscheck = stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($datacheck),
        'header' =>  "Content-Type: application/json\r\n",
    )
));


$responsecheck = file_get_contents($urlcheck, FALSE, $optionscheck);
// Check for errors
if ($responsecheck === FALSE) {
    print "ошибка";
}

//var_dump($response);

// Decode the response
$responseDatacheck = json_decode($responsecheck);

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