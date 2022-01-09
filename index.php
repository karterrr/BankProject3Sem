<?php
session_start();
require "server/config.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/sys_img/logo.png" type="image/x-icon">.
    <title>DruzhBank</title>
</head>

<body>
    <?php require "blocks/header.php" ?>

    <?php
    if (!isset($_SESSION['id'])) {
        header("Location:/auth.php");
    }
    ?>

    <div class="container mt-5">
        <div style="text-align: center;">
            <h3 class="newnews mb-5">Главная страница</h3>
        </div>


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
                    <tr class="col2" data-symbol="Доллар США" data-id="2" data-precision="">
                        <td class="amount arrow"><span class="style2ImgWrap"><img src="https://files.fortrader.org/service_uploads/country/flags/shiny/16/US.png" alt=""></span><a style="width: 27px;">USD</a></td>
                        <td class="changeVal" data-column="todayCourse">74.2926</td>
                    </tr>
                    <tr class="col2" data-symbol="Евро" data-id="21" data-precision="">
                        <td class="amount arrow"><span class="style2ImgWrap"><img src="https://files.fortrader.org/service_uploads/country/flags/shiny/16/EU.png" alt=""></span><a style="width: 27px;">EUR</a></td>
                        <td class="changeVal" data-column="todayCourse">84.0695</td>
                    </tr>
                    <tr class="col-data">
                        <td colspan="2" class="table_name"><time class="ftDateTime" datetime="2022-01-09UTC13:26">Дата <span class="ftDateTimeStr">09.01.2022</span></time></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- test -->
    <?php require "blocks/footer.php" ?>
</body>

</html>