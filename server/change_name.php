<?php

session_start();

require "config.php";

if(isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
    
        if (isset($_POST['new_login'])) { $new_login = $_POST['new_login']; if ($new_login == '') { unset($new_login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (mb_strtolower($new_login)==mb_strtolower($_SESSION['login']))
        {

            header("Location: /personal_block/account_set.php#popup1");
            exit( "Введённый вами логин совпадает с нынешним <br/>". "<a href= /personal_block/personal_area.php>Back</a>");

        }
        if (empty($new_login)) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
            {
                exit( "Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>". "<a href= /personal_block/account_set.php>Back</a>");
            }
        //если логин введен, то обрабатываем, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $new_login = stripslashes($new_login);
        $new_login = htmlspecialchars($new_login);
        //удаляем лишние пробелы
        $new_login = trim($new_login);
        // подключаемся к базе
        // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
        // проверка на существование пользователя с таким же логином

        $result = mysqli_query($db, "SELECT * FROM `users_attribute` WHERE `login`='$new_login'");
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