<?php
session_start();

require_once "config.php";
require_once "utils.php";

$responseData = api_call($api_url."/category", "POST", $data);

$array = $responseData->data;
//var_dump($array[0]);
$i = 0;
if ($responseData->success === TRUE) {
    while ($i < count($array)) {
?>
        <tbody onclick="window.click_pay(<?php echo $array[$i]->id?>);">
            <tr class="col2" >
                <td align="left"><?php echo $array[$i]->name ?></td>
            </tr>
        </tbody>
        <script>
            function click_pay(r) {        
                console.log(r);
                location.href = "./pay_main_info.php?id=" + r;
            }
        </script>
<?php
        $i = $i + 1;
    }
}
?>