<?php

require_once "envconfig.php";

$site_url = "http:localhost";

if($APP_MODE === MODE::DEBUG){
    $api_url = "http://lightfire.duckdns.org";
}else if ($APP_MODE === MODE::RELEASE){
    $api_url = "http://localhost:5000";
}