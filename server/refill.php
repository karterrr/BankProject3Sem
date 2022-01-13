<?php

session_start();

require "config.php";

if(isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
    
        if (isset($_POST['count'])) { $count = $_POST['count']; if ($count == '') { unset($count);} } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (empty($_POST['card_fill']) and empty($_POST['check_fill'])) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {          
            header( "Location:/refill.php?id=".$_POST['id']);  
        }
        if ($_POST['card_fill'] and $_POST['check_fill']) 
        {          
            header( "Location:/refill.php?id=".$_POST['id']);  
        }

        if ($_SESSION['password']!=$_POST['password'])
        {
            header("Location:/refill.php?id=".$_POST['id']);
        }



        //$password=$_SESSION['password'];
        //$login=$_SESSION['login'];


        

        if ($_POST['card_fill'])
        {
            $source=$_POST['card_fill'];
        }
        else
        {
            $source=$_POST['check_fill'];
        }

        if (strlen($source)==16)
        {
            $url = "http://lightfire.duckdns.org/refill";
        }
        else
        {
            $url = "http://lightfire.duckdns.org/pay";
        }

        $data = array(
            'token' => $_SESSION['id'],
            'source' => $source,
            'dest' => $_POST['dest_number'],
            'sum' => (int)$_POST['count'],
            'payType' => 0
        );

        var_dump($data);

        $options = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n",
            )
        ));

        $response = file_get_contents( $url, FALSE, $options);
        // Check for errors
        var_dump($response);
        if($response == FALSE){
            print "ошибка";
        }
 
         //var_dump($response);
 
         // Decode the response
        $responseData = json_decode($response);

        //var_dump($responseData);
        if($responseData==TRUE)
        {
           header("Location:/card_main_info.php?id=".$_POST['id']);
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