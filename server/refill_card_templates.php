<?php
session_start();



$datal = array(
    'token' => $_SESSION['id'],
);

$responseDatal = api_call($api_url."/getcards", "POST", $datal);

$arrayl = $responseDatal->data;
//var_dump($array[0]);
$il = 0;
if ($responseDatal->success === TRUE) {
    while ($il < count($arrayl)) {
        if($arrayl[$il]->is_blocked==FALSE)
        {
        if ($arrayl[$il]->number != $_COOKIE['select']) {
?>
            <option value=<?=$arrayl[$il]->number ?>><?= substr($arrayl[$il]->number, 0, 4), "****", substr($arrayl[$il]->number, 12, 15) ?></option>
<?php
        }
    }
        $il = $il + 1;
    
}
}
?>