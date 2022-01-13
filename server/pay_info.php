<?php
session_start();

require "config.php";

$url = "http://lightfire.duckdns.org/category";

$data = array(

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
if ($response == FALSE) {
    print "ошибка";
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
        <tbody class="card_info" onclick="window.click_pay(<?php echo $array[$i]->id?>);">
            <tr>
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