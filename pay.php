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
    <link rel="icon" href="/sys_img/logo.png" type="image/x-icon">
    <title>DruzhBank</title>
</head>
<?php require "blocks/header.php" ?>

<body>

    <?php
    if (!isset($_SESSION['id'])) {
        header("Location:/auth.php");
    }
    ?>
    <div class="container mt-5">
        <div style="text-align: center;">
            <h3 class="newnews mb-5">Платежи</h3>
        </div>

            <input type="radio" class="btn-check" name="radio" id="check_fill" autocomplete="off" checked>
            <label class="btn btn-secondary" for="check_fill">Платежи</label>
            <input type="radio" class="btn-check" name="radio" id="card_fill" autocomplete="off">
            <label class="btn btn-secondary" for="card_fill">Шаблоны</label>


            <div class="check_fill mt-3">
                <table name="check_fill" class="informer_table">
                    <thead>
                        <tr>
                            <th colspan="2" class="table_name"><a target="_blank">Список платежей</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require "./server/pay_info.php" ?>
                    </tbody>
                </table>
            </div>

            <div class="card_fill mt-3">
                <table name="card_fill" class="informer_table">
                    <thead>
                        <tr>
                            <th colspan="2" class="table_name"><a target="_blank">Список шаблонов</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="col2">
                            <th>Дата</th>
                            <th>Время</th>
                        </tr>
                        <?php //require "../server/lastlogins_info.php" 
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
    </div>
    </div>
    <!-- test -->
    <?php require "blocks/footer.php" ?>
</body>

</html>