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
    <script src="../js/show_pass.js"></script>
    <title>News Today</title>
</head>
<body>
    <?php require "../blocks/header.php" ?>

    <div class="menu container mt-5 justify-content-md-center text-center">
        <?php require "pa_blocks/pa_header.php" ?>
        <div class="row mt-5">
            <div class="form-control col rounded border bg-light border-2 pa-col">
                Сменить имя
                <form action="/server/change_name.php" method="post">
                    <h3 class="h4 mt-5">Ваше текущее имя</h3>
                    <h3 class="mt-4"><?php print $_SESSION['name']?></h3>
                    <input class="form-control mt-5 mb-2" type="text" name="new_name" placeholder="Новое имя" required=""/>
                    <div class="d-grid">
                        <button type="submit" name="sub" class="btn btn-primary mt-4 ">Изменить имя</button>
                    </div>
                </form>
                
                
            </div>
            <div class="form-control col rounded border bg-light border-2 pa-col">
                Сменить пароль
                <form action="/server/change_password.php" method="post">
                <div class="password">
                    <input id="password-input" class="form-control mt-5" type="password" name="cur_password" placeholder="Введите старый пароль" required=""/>
                    <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                </div>
                <div class="password">
                    <input id="password-input" class="form-control mt-4" type="password" name="new_password" placeholder="Новый пароль" required=""/>
                    <!-- <a href="#" class="password-control" onclick="return show_hide_password(this);"></a> -->
                </div>
                <div class="password">
                    <input id="password-input" class="form-control mt-4 mb-3" type="password" name="new_password_check" placeholder="Повторите пароль" required=""/>
                    <!-- <a href="#" class="password-control" onclick="return show_hide_password(this);"></a> -->
                </div>
                    <div class="d-grid">
                        <button type="submit" name="sub" class="btn btn-primary mt-4">Изменить пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require "../blocks/footer-min.php"?>
    <?php require "pa_popups/same_name_popup.php"?>
    <?php require "pa_popups/same_user_name_popup.php"?>
    <?php require "pa_popups/success_name_change_popup.php"?>
    <?php require "pa_popups/seccess_pass_change_popup.php"?>
    <?php require "pa_popups/incorrect_cur_pass_popup.php"?>
    <?php require "pa_popups/new_pass_eq_cur_pass_popup.php"?>
    <?php require "pa_popups/new_pass_neq_popup.php"?>
    <?php require "pa_popups/avatar_size_exeption.php"?>
    <?php require "pa_popups/support_popup.php"?>

</body>
</html>