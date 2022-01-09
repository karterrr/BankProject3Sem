
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="../js/copy_text.js"></script>
    <title>Gachi Bank</title>
</head>
<body>
    <?php require "blocks/header.php" ?>

    <div class="container md-5">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Свяжитесь с нами!</h2>
        <p class="text-center w-responsive mx-auto ">У вас есть какие-то вопросы? Хотите стать нашим редактором, разместить рекламу ну или просто поддержать копейкой наш проект? Не стесняйтесь и пишите нам на почту. Мы постораемся как можно быстрее помочь вам!</p>
        <div class="row">
            <div class="col">
            <img class="mx-auto d-block" src="sys_img/VK_logo.png" width="100px">
                <a class="text-decoration-none text-dark" href="https://vk.com/id240873722" target="_blank"><p class="mt-4 text-center">frontend developer</p></a>
                <a class="text-decoration-none text-dark" href="https://vk.com/dio_brando_karterr" target="_blank"><p class="mt-3 text-center">backend developer 1</p></a>
                <a class="text-decoration-none text-dark" href="https://vk.com/vroslyakov2002" target="_blank"><p class="mt-3 text-center">backend developer 2</p></a>  
            </div>
            <div class="col text-center">
                <img class="mx-auto d-block" src="sys_img/loc.png" width="100px">
                <a class="text-decoration-none text-dark" href="https://goo.gl/maps/cENSkVfmjE8VdcmJA" target="_blank"><p class="mt-1 text-center" onclick="copyElementText('myInp')">ул. Шепеткова, д. 14, Владивосток, Приморский край, 690013</p></a>            </div>
            <div class="col text-center">
                <img class="mx-auto d-block" src="sys_img/mail.png" width="100px">
                <p id="myInp" class="mt-4 text-center" onclick="copyElementText('myInp')">onlinesupport@info.newstoday.com</p>
                <h6 class="h6 text-secondary" style="font-size: 10px; margin-top: -3%!important;">Нажмите, чтобы скопировать</h6>
            </div>
            
        </div>
    </div>

    <?php require "blocks/footer-min.php" ?>
</body>
</html>