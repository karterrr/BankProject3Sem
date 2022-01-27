<?php
session_start();
require_once "server/config.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/sys_img/logo.png" type="image/x-icon">
    <title>DruzhBank</title>
</head>
<?php require_once "blocks/header.php" ?>
<body>

    <?php
    if (!isset($_SESSION['id'])) {
        header("Location:/auth.php");
    }
    ?>
    <div class="container mt-5">


        <?php

        //print $_SESSION['root'];
        //print $_SESSION['password'];
        //print $_SESSION['login'];
        //print $_SESSION['email'];
        //print $_SESSION['id'];
        /*
        if(isset($_SESSION['id']))
        {
            
            if($_SESSION['root']==1)
            {
            ?>
                    <button type="button" class="newnews btn btn-dark mb-5" onclick="document.location='newsform.php'">Добавить новость</button>

                <?php
            }
                
        }?>
        */
        ?>
        <!-- к этой кнопеке надо прикрутить проверку на админа хз как -->
        <div class="inlineBlock">
            <table class="informer_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name"><a target="_blank" >Курсы валют ЦБ РФ</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="col2">
                        <th>Валюта</th>
                        <th>RUB</th>
                    </tr>
                    <?php require_once "server/valute.php" ?>
                    <tr class="col-data">
                        <td colspan="2" class="table_name"><time class="ftDateTime" datetime="2022-01-09UTC13:26">Дата <span class="ftDateTimeStr"><?php echo $date ?></span></time></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>