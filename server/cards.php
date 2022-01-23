<?php
session_start();

require_once "config.php";
require_once "utils.php";

$data = array(
    'token' => $_SESSION['id']
);

$responseData = api_call($api_url."/getcards", "POST", $data);

// Print the date from the response
if($responseData -> success ===TRUE)
    {
    }
$array = $responseData->rates;

while ($valute_name = current($array)) {
    $real_valute = 1 / current($array);
    //print_r(round($real_valute,4));
    if (file_exists('./flags_img/' . key($array) . '.png')) {
?>
        <tr class="col2" data-symbol="Доллар США" data-id="2" data-precision="">
            <td class="amount arrow"><span class="style2ImgWrap"><img src="./flags_img/<?php echo key($array) ?>.png" with="16" height="16" alt=""></span><a style="width: 27px;"><?php echo key($array); ?></a></td>
            <td class="changeVal" data-column="todayCourse"><?php print_r(round($real_valute, 4)); ?></td>
        </tr>
<?php
    }
    //echo key($array), "\n";
    next($array);
}