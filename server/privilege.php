<?php

session_start();
require_once "config.php";

if($_SESSION['root']==1)
{
    $email=$_POST['email'];

    if(isset($_POST['ban']))
    {
        $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `root`=2 WHERE `email`='$email'");
        // Проверяем, есть ли ошибки
        if ($result2=='FALSE')
        {    
            //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ОШИБКА И ДАННЫЕ НЕ УДАЛОСЬ ИЗМЕНИТЬ
            //header('Location: /personal_block/account_set.php#popup4');
        }
        header("Location:/personal_block/users_info.php");
        
    }
    elseif(isset($_POST['unban']))
    {  
        $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `root`=0 WHERE `email`='$email'");
        // Проверяем, есть ли ошибки
        if ($result2=='FALSE')
        {    
            //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ОШИБКА И ДАННЫЕ НЕ УДАЛОСЬ ИЗМЕНИТЬ
            //header('Location: /personal_block/account_set.php#popup4');
        }
        header("Location:/personal_block/users_info.php");
    }
    elseif(isset($_POST['set_user']))
    {
        $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `root`=0 WHERE `email`='$email'");
        // Проверяем, есть ли ошибки
        if ($result2=='FALSE')
        {    
            //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ОШИБКА И ДАННЫЕ НЕ УДАЛОСЬ ИЗМЕНИТЬ
            header('Location: /personal_block/account_set.php#popup4');
        }
        header("Location:/personal_block/users_info.php");
    }
    elseif(isset($_POST['set_admin']))
    {
        $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `root`=1 WHERE `email`='$email'");
        // Проверяем, есть ли ошибки
        if ($result2=='FALSE')
        {    
            //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ОШИБКА И ДАННЫЕ НЕ УДАЛОСЬ ИЗМЕНИТЬ
            //header('Location: /personal_block/account_set.php#popup4');
        }
        header("Location:/personal_block/users_info.php");
    }
}
else
{
    header("Location: /index.php");
}
?>