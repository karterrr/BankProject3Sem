<?php

session_start();
require "config.php";

if($_SESSION['root']==1)
{
    if(isset($_POST['user_search']))
    {
        echo $_POST['user'];
        if($_POST['user'] == "")
        {
            $_SESSION['need_of_search']=FALSE;
            header("Location: ../personal_block/users_info.php");
        }
        else
        {
            $_SESSION['need_of_search']=TRUE;
            $_SESSION['search']=$_POST['user'];
        }

        header("Location: ../personal_block/users_info.php");
    }
    else
    {
        header("Location: /index.php");
    }
}
else
{
    header("Location: /index.php");
}
?>