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

        if ($_SESSION['password'] != $_POST['password']) {
            header("Location:/templates_main_info.php?id=" . $_POST['id']);
            exit();
        }

        if ($_POST['dest_type']==0)
        {
            $pay_type = 0;
        } elseif ($_POST['dest_type']==1) {
            $pay_type = 1;
        } else {
            $pay_type = 2;
        }

        $data = array(
            'token' => $_SESSION['id'],
            'source' => $_POST['source_number'],
            'dest' => $_POST['dest_number'],
            'sum' => (int)$_POST['count'],
            'payType' => $pay_type
        );
        if ($_POST['source_type'] == 0) {
            $responseData = api_call($api_url . "/refill", "POST", $data);
        } else {
            $responseData = api_call($api_url . "/pay", "POST", $data);
        }
        var_dump($responseData);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/pay.php");
            //print ("work");
        } else {
            header("Location:/templates_main_info.php?id=" . $_POST['id']);
            exit();
            echo "Ошибка! Платёж не проведён. Кто-то не сделал обход несуществующих карт";
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
