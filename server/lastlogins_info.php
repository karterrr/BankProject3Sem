<?php
session_start();

require "config.php";
require "utils.php";

$data = array(
    'token' => $_SESSION['id']
);

$responseData = api_call($api_url."/lastlogins", "POST", $data);

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