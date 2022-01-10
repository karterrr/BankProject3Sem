<?php 
session_start();
require "../server/config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">

    <title>News Today</title>
</head>
<body>
    <?php require "../blocks/header.php" ?>

    <div class="menu container mt-5 justify-content-md-center text-center">
        <?php require "pa_blocks/pa_header.php" ?>
        <div class=" row mt-5 rounded border bg-light border-2">
            <div class="col">
                Аватарка
            </div>
            <div class="col">
                Имя
            </div>
            <div class="col">
                Почта
            </div>
            <div class="col">
                Статус
            </div>
            <div class="w-100 mt-2"></div>
            <div class="user-img-div col mb-2">
                <?php
                if ($_SESSION['img'] == '')
                {
                ?>
                <img src="../img/upload_def_icon.jpg" class="user-img rounded-circle img-thumbnail">
                <?php
                }
                else
                {
                ?>
                    <img src="../<?php echo $_SESSION['img']; ?>" class="user-img rounded-circle img-thumbnail">
                <?php
                }
                ?>
                <!-- Тут отображается ава пользователя -->
            </div>
            <div class="col mt-5 h2">
                <?php
                   print $_SESSION['login']
                ?>
                <!-- Тут отображается Никнейм -->
            </div>
            <div class="col mt-5 h2">
                <?php
                   print $_SESSION['email']
                ?>
                <!-- Тут отображается логин -->
            </div>
            <div class="col mt-5 h2">
                <?php
                    if ($_SESSION['root'] == 0)
                    {
                        print '<h3 style="color:#6c757d";>Пользователь</h3>';
                    }
                    elseif ($_SESSION['root'] == 1)
                    {
                        print '<h3 style="color:#0dcaf0";>Админ</h3>';
                    }
                    if ($_SESSION['root'] == 2)
                    {
                        print '<h3 style="color:#dc3545";>Забен</h3>';
                    }
                ?>
                <!-- Тут отображается статус -->
            </div>
        </div>
    </div>
    

    <?php require "../blocks/footer-min.php" ?>
    <?php require "pa_popups/support_popup.php"?>
</body>
</html>