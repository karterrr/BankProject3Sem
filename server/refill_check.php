<?php
session_start();

require "config.php";
require "utils.php";

$datacheck = array(
    'token' => $_SESSION['id'],
);

$responseDatacheck = api_call($api_url."/getcheck", "POST", $datacheck);

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