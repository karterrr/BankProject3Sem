<?php

session_start();

require "config.php";

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['count'])) {
            $count = $_POST['count'];
            if ($count == '') {
                unset($count);
            }
        } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (empty($_POST['card_transit']) and empty($_POST['bank_number'])) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            header("Location:/transit.php?id=" . $_POST['id']);
        }
        if ($_POST['card_transit'] and $_POST['bank_number']) {
            header("Location:/transit.php?id=" . $_POST['id']);
        }
        if (strlen($_POST['bank_number']) != 16) {
            header("Location:/transit.php?id=" . $_POST['id']);
        }

        if ($_SESSION['password'] != $_POST['password']) {
            header("Location:/transit.php?id=" . $_POST['id']);
        }
        if (empty($_POST['count'])) {
            header("Location:/transit.php?id=" . $_POST['id']);
        }




        //$password=$_SESSION['password'];
        //$login=$_SESSION['login'];




        if ($_POST['card_transit']) {
            $dest_number = $_POST['card_transit'];
        } else {
            $dest_number = $_POST['bank_number'];
        }

        $url = "http://lightfire.duckdns.org/refill";


        $data = array(
            'token' => $_SESSION['id'],
            'source' => $_POST['source_number'],
            'dest' => $dest_number,
            'sum' => (int)$_POST['count'],
            'payType' => 0
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
        // Check for errors
        var_dump($response);
        if ($response == FALSE) {
            print "ошибка";
        }

        //var_dump($response);

        // Decode the response
        $responseData = json_decode($response);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/card_main_info.php?id=" . $_POST['id']);
            //print ("work");
        } else {
            echo "Ошибка! Платёж не проведён. Кто-то не сделал обход несуществующих карт";
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
