<?php
session_start();

require_once "config.php";
require_once "utils.php";

$datacheck = array(
    'token' => $_SESSION['id'],
);

$responseDatacheck = api_call($api_url."/getcheck", "POST", $data);

$arraycheck = $responseDatacheck->data;
//var_dump($array[0]);
$j = 0;
if ($responseDatacheck->success === TRUE) {
    while ($j < count($arraycheck)) {
?>
        <tbody class="card_info" onclick="window.clickb(<?php echo $arraycheck[$j]->id?>);">
            <tr>
                <td align="left"><?php if(($arraycheck[$j]->name)!=""){ echo $arraycheck[$j]->name;} else print "Текущий счёт"  ?></td>
                <td class="col2_main" rowspan="2"><?= $arraycheck[$j]->count ?></td>
            </tr>
            <tr>
                <td align="left" class="col2_main"><?php echo "****", substr($arraycheck[$j]->number, 4, 12) ?></td>
            </tr>
        </tbody>
        <script>
            function clickb(b) {        
                console.log(b);
                location.href = "./check_main_info.php?id=" + b;
            }
        </script>
<?php
        $j = $j + 1;
    }
}
?>