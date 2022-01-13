<?php
    session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/cur_backligth.js"></script>

<div class="container py-3">
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/index.php" class="d-flex align-items-center text-dark text-decoration-none">
                <img src="/sys_img/logo.png" wight="50" height="50"></img>
                <span class="fs-4">DruzhBank</span>
            </a>

            <nav class="menu d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="/index.php">Главная</a>
                <?php
                if(!isset($_SESSION['id']))
                {
                    ?>
                    <a class="btn btn-outline-secondary" href="/redirect.php">Вход/Регистрация</a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/pay.php">Платежи</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/bankomats.php">Банкоматы</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/valute.php">Котировки</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/personal_block/personal_area.php">Личный кабинет</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/contact.php">Контакты</a>
                    <a class="btn btn-outline-danger" href="/exit.php">Выход</a>
                    <?php
                }
                ?>
            </nav>
                
        </div>
    </div>