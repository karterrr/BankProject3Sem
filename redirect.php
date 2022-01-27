<?php
    //Отсылает пользователя на регистрацию, если нажать на кнопку входа
    //проверка базы данных на подключение, если не подключена, то можно убрать
    
    session_start();
    
    require_once "server/config.php";


    if(isset($_SESSION['id']))
    {
        header("Location:index.php");
    }
    else
    {
        header("Location:auth.php");
    }
?>