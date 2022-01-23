<?php

session_start();

require_once "config.php";

//include 'auth.php'

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['new_name'])) {
            $new_name = $_POST['new_name'];
            if ($new_name == '') {
                unset($new_name);
            }
        } 
        
        if (empty($new_name)) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>" . "<a href= /personal_block/account_set.php>Back</a>");
        }

        $new_name = stripslashes($new_name);
        $new_name = htmlspecialchars($new_name);

        $new_name = trim($new_name);


        $url = "http://lightfire.duckdns.org/edit/instrument/name";
        
        $data = array(
            'name' => $new_name,
            'token' => $_SESSION['id'],
            'number' => $_POST['number'],
            'instrument' => 1
        );
    
        $options = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($data),
                'header' =>  "Content-Type: application/json\r\n",
            )
        ));
    
    
        $response = file_get_contents($url, FALSE, $options);
        // Check for errors
        if ($response === FALSE) {
            print "ошибка";
        }
    
        //var_dump($response);
    
        // Decode the response
        $responseData = json_decode($response);
    
        if($responseData == TRUE)
        {
            header("Location:/check_main_info.php?id=".$_POST['id']);
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}

require_once "personal_block/pa_popups/same_user_name_popup.php";
require_once "personal_block/perpa_popups/success_name_change_popup.php";