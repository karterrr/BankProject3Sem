<?php
session_start();

require "config.php";

$url = "http://lightfire.duckdns.org/getcards";
?>



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
    print "блять";
}

//var_dump($response);

// Decode the response
$responseData = json_decode($response);

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