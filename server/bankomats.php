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
        function init(){
            myMap = new ymaps.Map("map", {
                center: [131.90580314735217, 43.08645022493277],
                zoom: 11 //0-19
            });
            <?php foreach($responseData as &$geoJS){ ?>

            var temp = JSON.parse(<?php echo json_encode($geoJS->coordinates) ?>);
            var objectManager = new ymaps.ObjectManager();
            objectManager.add(temp);
            myMap.geoObjects.add(objectManager);
             <?php }?>
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
?>
    <tbody class="card_info" onclick="window.focusPos(<?php $point = json_decode($array[$i]->coordinates)->features[0]->geometry->coordinates; echo $point[0].",".$point[1]?>);">
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
            <td class="col2_main"><?php echo "Часы работы:  ", substr($array[$i]->time_start, 0, 5), "-", substr($array[$i]->time_end, 0, 5) ?></td>
        </tr>
    </tbody>
<?php
    $i = $i + 1;
}
?>