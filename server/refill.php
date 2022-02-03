<?php

session_start();

require_once "config.php";
require_once "utils.php";

if(isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
    
        if (isset($_POST['count'])) { $count = $_POST['count']; if ($count == '') { unset($count);} } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if ($_POST['card_fill']=="null" and $_POST['check_fill']=="null") //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {          
            header( "Location:/refill.php?id=".$_POST['id']);  
            exit();
        }
        if ($_POST['card_fill']!="null" and $_POST['check_fill']!="null") 
        {          
            header( "Location:/refill.php?id=".$_POST['id']); 
            exit(); 
        }

        if ($_SESSION['password']!=$_POST['password'])
        {
            header("Location:/refill.php?id=".$_POST['id']);
            exit();
        }
        
        if ((int)$_POST['count']==0) {
            header("Location:/refill.php?id=".$_POST['id']);
            exit();
        }

        if ($_POST['card_fill']!="null")
        {
            $source=$_POST['card_fill'];
        }
        else
        {
            $source=$_POST['check_fill'];
        }

        if (strlen($source)==16)
        {
            $url = $api_url."/refill";
        }
        else
        {
            $url = $api_url."/pay";
        }

        $data = array(
            'token' => $_SESSION['id'],
            'source' => $source,
            'dest' => $_POST['dest_number'],
            'sum' => (int)$_POST['count'],
            'payType' => 0
        );

        $responseData = api_call($url, "POST", $data);

        //var_dump($responseData);
        if($responseData==TRUE)
        {
           header("Location:/card_main_info.php?id=".$_POST['id']."&page=1");
           //print ("work");
        }
        else
        {
            echo "Ошибка! Пароль не изменён";
        }
    }
    else
    {
        header("Location:/index.php");
    }
}
else
{
    header("Location:/index.php");
}
?>