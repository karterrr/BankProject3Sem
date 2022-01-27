<?php
session_start();

require_once "config.php";
require_once "utils.php";

$url = "http://lightfire.duckdns.org";

$data = array(
    'token' => $_SESSION['id'],
);

$responseData = api_call($api_url."/getcards", "POST", $data);

$array = $responseData->data;
//var_dump($array[0]);
$i = 0;
if ($responseData->success === TRUE) {
    while ($i < count($array)) {
?>
        <tbody class="card_info" onclick="window.clicka(<?php echo $array[$i]->id?>);">
            <tr>
                <td align="left"><?php echo $array[$i]->name ?></td>
                <td class="col2_main" rowspan="2"><?php echo $array[$i]->count ?></td>
            </tr>
            <tr>
                <td align="left" class="col2_main"><?php echo substr($array[$i]->number, 0, 4), "****", substr($array[$i]->number, 12, 15) ?></td>
            </tr>
        </tbody>
        <script>
            function clicka(a) {        
                console.log(a);
                location.href = "./card_main_info.php?id=" + a;
            }
        </script>
<?php
        $i = $i + 1;
    }
}
?>