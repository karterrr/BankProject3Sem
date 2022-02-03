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

        if ($_POST['check_fill']!="null")
        {
            $source = $_POST['check_fill'];
            $source_type = 1;
        }
        else
        {
            $source = $_POST['card_fill'];
            $source_type = 0;
        }

        if ($_POST['dest_card']!=null)
        {
            $dest = $_POST['dest_card'];
            $dest_type = 0;
        }
        else
        {
            $dest = $_POST['dest_pay'];
            $dest_type = 2;
        }

        if ($_POST['template_name']==null){
            header("Location:/templates_new.php");
            exit("3");
        }

        if ($_POST['card_fill']==$_POST['dest_card']){
            header("Location:/templates_new.php");
            exit("3");
        }

        if ($_SESSION['password'] != $_POST['password']) {
            header("Location:/templates_new.php");
            exit("1");
        }
        if ((int)$_POST['count']==0) {
            header("Location:/templates_new.php");
            exit("2");
        }

        if ($_POST['check_fill']=="null" and $_POST['card_fill']=="null"){
            header("Location:/templates_new.php");
            exit("3");
        }

        if ($_POST['check_fill']!="null" and $_POST['card_fill']!="null"){
            header("Location:/templates_new.php");
            exit("4");
        }
        
        $data = array(
            'token' => $_SESSION['id'],
            'source' => $source,
            'dest' => $dest,
            'source_type' => $source_type,
            'dest_type' => $dest_type,
            'name' => $_POST['template_name'],
            'sum' => (int)$_POST['count']
        );
        var_dump($data);
        $responseData = api_call($api_url."/templates/set", "POST", $data);
        var_dump($responseData);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/pay.php");
            //print ("work");
        } else {
            header("Location:/templates_new.php");
            exit("5");
            echo "Ошибка! Платёж не проведён. Кто-то не сделал обход несуществующих карт";
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
