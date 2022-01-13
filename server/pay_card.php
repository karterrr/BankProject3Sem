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
            <option value=<?=$array[$i]->number ?>><?= substr($array[$i]->number, 0, 4), "****", substr($array[$i]->number, 12, 15) ?></option>
<?php
        
        $i = $i + 1;
    }
}
?>