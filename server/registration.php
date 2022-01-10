<?php

session_start();

require "config.php";

if(!isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {

        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        if (isset($_POST['name'])) { $name=$_POST['name']; if ($name =='') { unset($name);} }
        //print $email." ".$password;

        //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
        if (empty($login) or empty($password) or empty($name)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
            {
                exit( "Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>". "<a href= /registration.php>Back</a>");
            }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        //удаляем лишние пробелы
        $login = trim($login);
        $password = trim($password);

        $name=$_POST['name'];
        $login=$_POST['login'];
        $password=$_POST['password'];

        
        $url = "http://lightfire.duckdns.org/signin";
        
        $data = array(
            'name' => $name,
            'login' => $login,
            'password' => $password
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
        if($response === FALSE){
            print "блять";
        }

        //var_dump($response);

        // Decode the response
        $responseData = json_decode($response);

        // Print the date from the response
        if($responseData -> success ===TRUE)
        {
            $_SESSION['id'] = $responseData -> data;
            $_SESSION['password']=$password;
            $_SESSION['login']=$login;
            $_SESSION['name']=$name;

            header("Location:/index.php");
        }
        else
        {
            header("Location: /registration_error.php");
        }
        // подключаемся к базе
        // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
        // проверка на существование пользователя с таким же логином

        /*
        $result = mysqli_query($db, "SELECT * FROM `users_attribute` WHERE `email`='$email'");
        $myrow = mysqli_fetch_array($result);

        if (!empty($myrow['id'])) 
        {
            header("Location: /registration_error.php");
            exit( "Извините, введённая вами почта или логин уже зарегистрированы. Введите другую почту и логин. <br/>". "<a href= /registration.php>Back</a>");
        }

        // если такого нет, то сохраняем данные
        $result2 = mysqli_query ($db,"INSERT INTO `users_attribute` (`root`,`email`,`login`,`password`,`img`) VALUES(0,'$email','$login','$password','')");
        // Проверяем, есть ли ошибки
        if ($result2=='TRUE')
        {
            
            //echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='/index.php'>Главная страница</a>";
            $query=mysqli_query($db, "SELECT * FROM `users_attribute` WHERE `email`='$email' AND `password`='$password' ");

            if(mysqli_num_rows($query)>0)
            {
                $user=mysqli_fetch_assoc($query);
                $id=$user['id'];
                $root=$user['root'];
                $img=$user['img'];
                $_SESSION['password']=$password;
                $_SESSION['login']=$login;
                $_SESSION['email']=$email;
                $_SESSION['root']=$user['root'];
                $_SESSION['id']=$user['id'];
                $_SESSION['img']=$img;
            }
            header('Location: /index.php');
        }
        else {
        echo "Ошибка! Вы не зарегистрированы.";
        }
        */
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