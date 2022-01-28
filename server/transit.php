<?php

session_start();

require_once "config.php";
require_once "utils.php";

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
        
        $data = array(
            'token' => $_SESSION['id'],
            'source' => $_POST['source_number'],
            'dest' => $dest_number,
            'sum' => (int)$_POST['count'],
            'payType' => 0
        );
        $responseData = api_call($api_url."/refill", "POST", $data);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/card_main_info.php?id=" . $_POST['id']."&page=1");
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
