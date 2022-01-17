<?php

session_start();

require "config.php";
require "utils.php";

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['count'])) {
            $count = $_POST['count'];
            if ($count == '') {
                unset($count);
            }
        } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (empty($_POST['bank_number']) or empty($_POST['card_pay'])) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            header("Location:/pay_main_info.php?id=" . $_POST['id']);
            exit();
        }

        if ($_SESSION['password'] != $_POST['password']) {
            header("Location:/pay_main_info.php?id=" . $_POST['id']);
            exit();
        }

        if ($_POST['card_pay']) {
            $source = $_POST['card_pay'];
        }

        $responseDatacategory = api_call($api_url."/category", "POST", $data);

        $arraycategory = $responseDatacategory->data;
        //var_dump($array[0]);
        $e = 0;
        if ($responseDatacategory->success === TRUE) {
            while ($e < count($arraycategory)) {
                if($_POST['id']==$arraycategory[$e]->id)
                {
                    $dest=$arraycategory[$e]->name;
                }
                $e = $e + 1;
            }
        }
        
        $data = array(
            'token' => $_SESSION['id'],
            'source' => $source,
            'dest' => $dest,
            'sum' => (int)$_POST['count'],
            'payType' => 2
        );

        $responseData = api_call($api_url."/refill", "POST", $data);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/pay.php");
            //print ("work");
        } else {
            echo "Ошибка! Пароль не изменён";
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
