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
    print "ошибка";
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
        <option value=<?=$arraycheck[$j]->number?>><?= "****", substr($arraycheck[$j]->number, 4, 12)?></option>
<?php
        $j = $j + 1;
    }
}
?>