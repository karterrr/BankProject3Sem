<?php

session_start();

require "config.php";

if(isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {
    
        if (isset($_POST['cur_password'])) { $cur_password = $_POST['cur_password']; if ($cur_password == '') { unset($cur_password);} } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную
        if (isset($_POST['new_password'])) { $new_password = $_POST['new_password']; if ($new_password == '') { unset($new_password);} }
        if (isset($_POST['new_password_check'])) { $new_password_check = $_POST['new_password_check']; if ($new_password_check == '') { unset($new_password_check);} }
        //print $email." ".$password;
        if (empty($cur_password) or empty($new_password) or empty($new_password_check)) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            exit( "Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br/>". "<a href= /personal_block/account_set.php>Back</a>");
        }
        if ($cur_password!=$_SESSION['password'])
        {
            header('Location: /personal_block/account_set.php#popup5');
            exit( "Вы ввели не правильный текущий пароль <br/>". "<a href= /personal_block/account_set.php>Back</a>");
        }
        if ($new_password!=$new_password_check)
        {
            header('Location: /personal_block/account_set.php#popup7');
            exit( "Новый пароль не совпал с повторённым паролем <br/>". "<a href= /personal_block/account_set.php>Back</a>");
        }
        if ($cur_password==$new_password)
        {
            header('Location: /personal_block/account_set.php#popup6');
            exit( "Новый пароль совпадает с текущим <br/>". "<a href= /personal_block/account_set.php#popup6>Back</a>");
        }
        //если логин введен, то обрабатываем, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $cur_password = stripslashes($cur_password);
        $cur_password = htmlspecialchars($cur_password);
        $new_password = stripslashes($new_password);
        $new_password = htmlspecialchars($new_password);
        $new_password_check = stripslashes($new_password_check);
        $new_password_check = htmlspecialchars($new_password_check);
        //удаляем лишние пробелы
        $cur_password = trim($cur_password);
        $new_password = trim($new_password);
        $new_password_check = trim($new_password_check);

        //$password=$_SESSION['password'];
        //$login=$_SESSION['login'];


        $url = "http://lightfire.duckdns.org/editepassword";


        $data = array(
            'old_password' => $cur_password,
            'new_password' => $new_password,
            'token' => $_SESSION['id']
        );

       // var_dump($data);

        $options = stream_context_create(array(
            'http' => array(
                'method'  => 'PUT',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n",
            )
        ));

        $response = file_get_contents( $url, FALSE, $options);
        // Check for errors
        if($response === FALSE){
            print "ошибка";
        }
 
         //var_dump($response);
 
         // Decode the response
        $responseData = json_decode($response);

        //var_dump($responseData);
        if($responseData -> success ===TRUE)
        {
            $_SESSION['password'] = $new_password;
            $_SESSION['id']= $responseData -> data;

           header('Location: /personal_block/account_set.php#popup4');
           //print ("work");
        }
        else
        {
            echo "Ошибка! Пароль не изменён";
        }

        // сохраняем данные
        /*$result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `password`='$new_password' WHERE `login`='$login'");
        // Проверяем, есть ли ошибки
        if ($result2=='TRUE')
        {
            $_SESSION['password']=$new_password;

            //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ПАРОЛЬ УСПЕШНО ИЗМЕНЁН
            header('Location: /personal_block/account_set.php#popup4');
        }
        else 
        {
            echo "Ошибка! Пароль не изменён";
        }*/
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