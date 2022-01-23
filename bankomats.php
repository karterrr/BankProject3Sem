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
        <div style="text-align: center;">
        </div>

        <!-- к этой кнопеке надо прикрутить проверку на админа хз как -->
        <div class="inlineBlock">
            <table class="card_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name"><a target="_blank">Список банкоматов</a></th>
                    </tr>
                </thead>
                <?php require_once "./server/bankomats.php" ?>
            </table>
        </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>