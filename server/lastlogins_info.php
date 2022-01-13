<?php
session_start();

require "config.php";

$url = "http://lightfire.duckdns.org/lastlogins";

$data = array(
    'token' => $_SESSION['id']
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

if ($responseData->success === TRUE) {
    $array = $responseData->data;
    $i = 0;
    while ($i < count($array)) {
        if ($i < 5) {
?>
            <tr class="col2">
                <td class="amount arrow"><?php echo substr($array[$i]->date_visit, 0, 10) ?></a></td>
                <td class="changeVal"><?php echo substr($array[$i]->date_visit, 11, 8) ?></td>
            </tr>
<?php
            $i = $i + 1;
        }
        else{
            break;
        }
    }
}
?>