<?php
session_start();

require_once "config.php";
require_once "utils.php";

$responseData = api_call($api_url."/bankomats", "GET", "");
?>
    <head>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=1686f571-4eca-47b9-9d13-41760ee3db8d&lang=ru_RU&coordorder=longlat" type="text/javascript">
        </script>
    </head>
    <div id="map_section">
        <title>Карта банкоматов</title>
        <script type="text/javascript">
        ymaps.ready(init);
        var myMap = null;
        var markerArray = [];
        function init(){
            myMap = new ymaps.Map("map", {
                center: [131.90580314735217, 43.08645022493277],
                zoom: 11 //0-19
            });
            for(const elem of markerArray){
                myMap.geoObjects.add(new ymaps.Placemark((elem), { balloonContentHeader: elem.type,
                balloonContentBody: elem.adress,
                balloonContentFooter: elem.time,
                hintContent: elem.type}))
            }
        }
        function focusPos(long, lat){
            if(myMap != null){
                myMap.setCenter([long, lat], 14, {
                  duration: 300
               });
            }
        }
        </script>
       <div id="map" style="width: 90%; height: 400px"></div>
   </div>
<?php

// Print the date from the response
$date = $responseData->date;

$array = $responseData;

$i = 0;
while ($i < count($array)) {
?>  <script type="text/javascript"> var curPoint = [<?php $pointArray = json_decode($array[$i]->coordinates)->features[0]->geometry->coordinates; $pointString = $pointArray[0].",".$pointArray[1]; echo $pointString; $array[$i]->time = "Часы работы:  ".substr($array[$i]->time_start, 0, 5)."-".substr($array[$i]->time_end, 0, 5); ?>];
    curPoint.type = "<?php if ($array[$i]->is_atm) {echo "Банкомат"; } else {echo "Отделение банка"; }?>"; curPoint.adress = "<?= $array[$i]->adress?>"; curPoint.time = "<?= $array[$i]->time ?>"; markerArray.push(curPoint);
    </script>
    <tbody class="card_info" onclick="window.focusPos(<?= $pointString ?>);">
        <tr>
            <td align="left" colspan="2"><?= $array[$i]->adress ?></td>

        </tr>
        <tr>
            <td align="left" class="col2_main"><?php if ($array[$i]->is_atm) {
                                                    echo "Банкомат:   ";
                                                } else {
                                                    echo "Отделение:   ";
                                                }
                                                if ($array[$i]->is_working) { ?> <p1 style="color: green;">Работает</p1> <?php } else {
                                                                                                                            ?> <p1 style="color: red;">Не работает</p1> <?php
                                                                                                                        } ?></td>
            <td class="col2_main"><?= $array[$i]->time?></td>
        </tr>
    </tbody>
<?php
    $i = $i + 1;
}
?>