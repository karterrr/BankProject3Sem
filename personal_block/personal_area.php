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
                Логин
            </div>
            <div class="col">
                Имя
            </div>
            <div class="w-100 mt-2"></div>
            <div class="col mt-3 mb-4 h2">
                <?php
                print $_SESSION['login']
                ?>
                <!-- Тут отображается Никнейм -->
            </div>
            <div class="col mt-3 mb-4 h2">
                <?php
                print $_SESSION['name']
                ?>
                <!-- Тут отображается логин -->
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="inlineBlock">
            <table class="informer_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name"><a target="_blank">Список последних посещений</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="col2">
                        <th>Дата</th>
                        <th>Время</th>
                    </tr>
                    <tr class="col2">
                        <td class="amount arrow">22.05.2021</a></td>
                        <td class="changeVal">22:05</td>
                    </tr>
                    <tr class="col2">
                        <td class="amount arrow">01.06.2022</a></td>
                        <td class="changeVal">14:27</td>
                    </tr>
                    <tr class="col2">
                        <td class="amount arrow">11.01.2022</a></td>
                        <td class="changeVal">04:05</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <?php require "../blocks/footer-min.php" ?>
    <?php require "pa_popups/support_popup.php" ?>
</body>

</html>