<?php

session_start();

require "config.php";
require "utils.php";

//include 'auth.php'

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['new_name'])) {
            $new_name = $_POST['new_name'];
            if ($new_name == '') {
                unset($new_name);
            }
        } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (mb_strtolower($new_name) == mb_strtolower($_SESSION['name'])) {

            header("Location: /personal_block/account_set.php#popup1");
            exit("Введённое вами имя совпадает с нынешним <br/>" . "<a href= /personal_block/personal_area.php>Back</a>");
        }
        if (empty($new_name)) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>" . "<a href= /personal_block/account_set.php>Back</a>");
        }
        //если логин введен, то обрабатываем, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $new_name = stripslashes($new_name);
        $new_name = htmlspecialchars($new_name);
        //удаляем лишние пробелы
        $new_name = trim($new_name);
        // подключаемся к базе
        // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
        // проверка на существование пользователя с таким же логином

        // $token = $_SESSION['id'] -> data -> token;

        // print $token;
        
        $data = array(
            'name' => $new_name,
            'token' => $_SESSION['id']

        );

        $responseData = api_call($api_url."/editeusername", "PUT", $data);

        //var_dump($response);
        // Print the date from the response
        if ($responseData == TRUE) {
            
            $_SESSION['name'] = $new_name;
            header('Location: /personal_block/account_set.php#popup3');

        } else {
            exit("Не удалось сменить имя <br/>" . "<a href= /personal_block/account_set.php>Back</a>");
        }

        /*$result = mysqli_query($db, "SELECT * FROM `users_attribute` WHERE `login`='$new_login'");
        $myrow = mysqli_fetch_array($result);

        if (!empty($myrow['id'])) 
        {
            header("Location: /personal_block/account_set.php#popup2");
            //header("Location: /registration_error.php");
            exit( "Извините, введённая вами почта или логин уже зарегистрированы. Введите другую почту и логин. <br/>". "<a href= /personal_block/account_set.php>Back</a>");
        }

        $login=$_SESSION['login'];
        // сохраняем данные
        $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `login`='$new_login' WHERE `login`='$login'");
        // Проверяем, есть ли ошибки
        if ($result2=='TRUE')
        {
            $_SESSION['login']=$new_login;

            //!!!ВОТ ТУТ СДЕЛАТЬ ПОП АП, ЧТО ИМЯ УСПЕШНО ИЗМЕНЁНО
            header('Location: /personal_block/account_set.php#popup3');
        }
        else {
            echo "Ошибка! Пароль не изменён";
        }*/
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
