<?php
session_start();

require_once "config.php";
require_once "utils.php";

$data = array(
    'token' => $_SESSION['id'],
);

$responseData = api_call($api_url."/category", "POST", $data);

$array = $responseData->data;
//var_dump($array[0]);
$i = 0;
if ($responseData->success === TRUE) {
    while ($i < count($array)) {
        if ($array[$i]->id != $_GET['id']) {
?>
            <option value=<?=$array[$i]->number ?>><?= substr($array[$i]->number, 0, 4), "****", substr($array[$i]->number, 12, 15) ?></option>
<?php
        }
        else{
            $this_card=$array[$i]->number;
        }
        $i = $i + 1;
    }
}
?>