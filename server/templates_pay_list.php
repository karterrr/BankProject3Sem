<?php
session_start();



$responseDatacategory = api_call($api_url . "/category", "POST", $data);

$arraycategory = $responseDatacategory->data;
//var_dump($array[0]);
$e = 0;
if ($responseDatacategory->success === TRUE) {
    while ($e < count($arraycategory)) {
?>
        <option value=<?= $arraycategory[$e]->id ?>><?= $arraycategory[$e]->name ?></option>
<?php
        $e = $e + 1;
    }
}

?>