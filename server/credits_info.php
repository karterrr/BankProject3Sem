<?php
session_start();

require "config.php";

$url = "http://lightfire.duckdns.org/getcredits";
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

$options = stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($data),
        'header' =>  "Content-Type: application/json\r\n",
    )
));


$response = file_get_contents($url, FALSE, $options);
// Check for errors
if ($response === FALSE) {
    print "ошибка";
}

//var_dump($response);

// Decode the response
$responseData = json_decode($response);

$array = $responseData->data;
//var_dump($array[0]);
$i = 0;
if ($responseData->success === TRUE) {
    while ($i<count($array)) {
        ?>
        <tbody class="card_info" onclick="window.click();">
                <tr>
                    <td align="left"><?=$array[$i]->name?></td>
                    <td class="col2_main" rowspan="2"><?=  $array[$i]->count ?></td>
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