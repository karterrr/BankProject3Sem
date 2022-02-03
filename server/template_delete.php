<?php

session_start();

require_once "config.php";
require_once "utils.php";

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        
        
        $data = array(
            'token' => $_SESSION['id'],
            'id' => (int)$_POST['id']
        );
        $responseData = api_call($api_url."/templates/delete", "DELETE", $data);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/pay.php");
            //print ("work");
        } else {
            
            header("Location:/pay.php");
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
