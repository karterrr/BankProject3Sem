<?php
session_start();

if(isset($_SESSION['id']))
{
    unset($_SESSION['id']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    unset($_SESSION['root']);
    unset($_SESSION['login']);
    unset($_SESSION['img']);
    unset($_SESSION['need_of_search']);
    header("Location: index.php");
}
else
{
    header("Location: index.php");
}

?>