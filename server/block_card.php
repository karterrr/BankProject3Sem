<?php

session_start();

require "config.php";

//include 'auth.php'

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            if ($password == '') {
                unset($password);
            }
        }

        if (empty($password)) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>" . "<a href= /personal_block/account_set.php>Back</a>");
        }

        $password = stripslashes($password);
        $password = htmlspecialchars($password);

        $password = trim($password);

        if ($password == $_SESSION['password']) {
            $url = "http://lightfire.duckdns.org/block";

            $data = array(
                'number' => $_POST['number'],
                'token' => $_SESSION['id']
            );
            var_dump($data);
            $options = stream_context_create(array(
                'http' => array(
                    'method'  => 'POST',
                    'content' => json_encode($data),
                    'header' =>  "Content-Type: application/json\r\n",
                )
            ));


            $response = file_get_contents($url, FALSE, $options);
            var_dump($response);
            // Check for errors
            if ($response === FALSE) {
                print "ошибка";
            }

            //var_dump($response);

            // Decode the response
            $responseData = json_decode($response);

            if ($responseData == TRUE) {
                header("Location:/card_main_info.php?id=".$_POST['id']);
            }
        }
        else
        {
            header("Location:/card_main_info.php?id=".$_POST['id']);
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
