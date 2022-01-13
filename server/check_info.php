<?php
session_start();

require "config.php";

$urlcheck = "http://lightfire.duckdns.org/getcheck";
?>



<?php
$datacheck = array(
    'token' => $_SESSION['id'],
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
    print "блять";
}

//var_dump($response);

// Decode the response
$responseDatacheck = json_decode($responsecheck);

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