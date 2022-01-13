<?php
session_start();

require "config.php";

$url = "http://lightfire.duckdns.org/valute";




$response = file_get_contents($url);
// Check for errors

//var_dump($response);

// Decode the response
$responseData = json_decode($response)->ValCurs;

// Print the date from the response
$date = $responseData->@Date;

$array = $responseData->Valute;

foreach ($array as $cur ) {
    if (file_exists('./flags_img/' . $cur->CharCode . '.png')) {
?>
        <tr class="col2" data-symbol="Доллар США" data-id="2" data-precision="">
            <td class="amount arrow"><span class="style2ImgWrap"><img src="./flags_img/<?php echo key($array) ?>.png" with="16" height="16" alt=""></span><a style="width: 27px;"><?php echo $cur->CharCode; ?></a></td>
            <td class="changeVal" data-column="todayCourse"><?php echo $cur->Value; ?></td>
        </tr>
<?php
    }
}
?>
