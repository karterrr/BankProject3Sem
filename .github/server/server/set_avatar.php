<?php
    session_start();

    require "config.php";
?>

<?php

if(isset($_SESSION['id']))
{
    if(isset($_POST['sub']))
    {   $size = 1024000;
        $old_img=$_SESSION['img'];
        if ($_FILES['file']['size'] > $size)
        {
            header('Location: /personal_block/account_set.php#popup8');
            echo 'Давай файл поменьше';
            exit ("Давай файл поменьше");
        }
        else
        {
            //$result = mb_substr($old_img, 4);
            $name = mt_rand(0, 10000) . $_FILES['file']['name'];
            if(copy($_FILES['file']['tmp_name'], '../img/' . $name))
            {
                $login = $_SESSION['login'];
                $result2 = mysqli_query ($db,"UPDATE `users_attribute` SET `img`='img/$name' WHERE `login`='$login'");
                // Проверяем, есть ли ошибки
                if ($result2=='TRUE')
                {
                    $_SESSION['img']='img/'.$name;
                    $file=$old_img;
                    unlink($_SERVER['DOCUMENT_ROOT'].'/'.$file);

                    //!!!!!ВОТ ТУТ СДЕЛАТЬ ПОП ИТ, ЧТО ПАРОЛЬ УСПЕШНО ИЗМЕНЁН
                    header('Location: /personal_block/account_set.php');
                }
                else 
                {
                    echo "Ошибка! Аватар не изменён";
                }
            }
            else
            {
                header('Location: /personal_block/account_set.php#popup8');
                exit( "Извините, введённая вами почта или логин уже зарегистрированы. Введите другую почту и логин. <br/>". "<a href= /registration.php>Back</a>");
            }
        }

    }
    else
    {
        header("Location:/personal_block/account_set.php#popup8");
    }
}
else
{
    header("Location:/personal_block/account_set.php#popup6");
}
 
?>