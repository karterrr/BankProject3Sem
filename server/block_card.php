<?php

session_start();

require_once "config.php";
require_once "utils.php";

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
            $data = array(
                'number' => $_POST['number'],
                'token' => $_SESSION['id']
            );
           
            $responseData = api_call($api_url."/block", "POST", $data);

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
