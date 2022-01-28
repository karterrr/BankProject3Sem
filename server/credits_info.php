<?php
session_start();

require_once "config.php";
require_once "utils.php";

?>

<script>
    function click() {
    console.log("click is called");
  }
</script>

<?php
$data = array(
    'token' => $_SESSION['id'],
);

$responseData = api_call($api_url."/getcredits", "POST", $data);

$array = $responseData->data;
//var_dump($array[0]);
$i = 0;
if ($responseData->success === TRUE) {
    while ($i<count($array)) {
        ?>
        <tbody class="card_info" onclick="window.click();">
                <tr>
                    <td align="left"><?=$array[$i]->name?></td>
                    <td class="col2_main" rowspan="2"><?=  $array[$i]->count," руб." ?></td>
                </tr>
                <tr>
                    <td align="left" class="col2_main"><?php echo substr($array[$i]->payment_date, 0, 10) ?></td>
                </tr>
            </tbody>
        <?php
        $i = $i + 1;
    }
}
?>