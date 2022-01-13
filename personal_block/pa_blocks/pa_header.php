<?php

session_start();

if(isset($_SESSION['id']))
{
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../../js/cur_backligth.js"></script>
<div class="row">
    <div class="col">
        <a class="text-dark text-decoration-none" href="personal_area.php">Мой профиль</a>
    </div>
    <div class="col">
        <a class="text-dark text-decoration-none" href="account_set.php">Настройки аккаунта</a>
    </div>
    <div class="col">
        <a class="text-dark text-decoration-none" href="#popup9">Поддержка</a>
    </div>
    
</div>

<?php
}
else
{
    //тут надо как-то переписать, чтобы ссылалось обратно на главную страницу
    header("Location:/index.php");
}
?>