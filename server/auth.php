<?php
session_start();

require "config.php";

if(!isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];

        //print $email." ".$password;

        $query=mysqli_query($db, "SELECT * FROM `users_attribute` WHERE `email`='$email' AND `password`='$password' ");

        if(mysqli_num_rows($query)>0)
        {
            $user=mysqli_fetch_assoc($query);
            $img=$user['img'];
            $id=$user['id'];
            $root=$user['root'];
            $login=$user['login'];
            $_SESSION['password']=$password;
            $_SESSION['login']=$login;
            $_SESSION['email']=$email;
            $_SESSION['root']=$root;
            $_SESSION['id']=$id;
            $_SESSION['img']=$img;
            //на главную страницу, если вход успешен
            header("Location: /index.php");
        }
        else
        {  
            //print '';
            //print "<a href= /auth.php>Back</a>";
            header("Location: /auth_error.php");
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