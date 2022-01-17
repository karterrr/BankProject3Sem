<?php
session_start();

require "config.php";
require "utils.php";

if(!isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
        $login=$_POST['login'];
        $password=$_POST['password'];
        
        $data = array(
            'login' => $login,
            'password' => $password
        );
        $responseData = api_call($api_url."/login", "POST", $data);

        // Print the date from the response
        if($responseData -> success ===TRUE)
        {
            $_SESSION['id'] = $responseData -> data -> token;
            $_SESSION['password']=$password;
            $_SESSION['login']=$login;
            $_SESSION ['name'] = $responseData -> data -> name;
            /*
            $datagetuser = array(
                'login' => $login,
                'password' => $password
            );
    
            $optionsgetuser = stream_context_create(array(
                'http' => array(
                    'method'  => 'POST',
                    'content' => json_encode( $datagetuser ),
                    'header'=>  "Content-Type: application/json\r\n",
                )
            ));
    
    
            $responsegetuser = file_get_contents( $url, FALSE, $optionsgetuser);
            // Check for errors
            if($responsegetuser === FALSE){
                print "ошибка";
            }

            $responseDatagetuser = json_decode($responsegetuser);

            $_SESSION ['name'] = $responseDatagetuser -> data -> name;
            var_dump($responseDatagetuser);
            */

            header("Location:/index.php");
        }
        else
        {
            header("Location: /auth_error.php");
        }


        /*
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
    */
}
}
else
{
    header("Location:/index.php");
}
?>