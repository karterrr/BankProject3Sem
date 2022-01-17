<?php

function api_call($url, $method, $data){  
    $options = stream_context_create(array(
        'http' => array(
            'method'  => $method,
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n",
        )
    ));

    $response = file_get_contents($url, FALSE, $options);
    if($response == FALSE){
        print "ошибка";
    }

    return json_decode($response);
}
?>