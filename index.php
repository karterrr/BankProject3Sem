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
            <h3 class="newnews mb-5"><?php echo $_SESSION['name']; ?></h3>
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
            <table class="card_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name_main"><a target="_blank">МОИ КАРТЫ</a></th>
                    </tr>
                </thead>
                <?php require "./server/card_info.php" ?>
            </table>
            <table class="card_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name_main"><a target="_blank">МОИ СЧЕТА</a></th>
                    </tr>
                </thead>
                <?php require "./server/check_info.php" ?>
            </table>
            <table class="card_table">
                <thead>
                    <tr>
                        <th colspan="2" class="table_name_main"><a target="_blank">МОИ КРЕДИТЫ</a></th>
                    </tr>
                </thead>
                <?php require "./server/credits_info.php" ?>
            </table>
        </div>
    </div>
    <!-- test -->
    <?php require "blocks/footer.php" ?>
</body>

</html>