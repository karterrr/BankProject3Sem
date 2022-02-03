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
    <a href="/card_main_info.php?id=<?=$_GET['id']?>&page=1">Назад</a>
        <div style="text-align: center;">
            <h3 class="newnews mb-5">Пополнение</h3>
        </div>

        <form action="/server/refill.php" method="post">

            <input type="radio" class="btn-check" name="radio" id="check_fill" autocomplete="off" checked>
            <label class="btn btn-secondary" for="check_fill">Со счёта</label>
            <input type="radio" class="btn-check" name="radio" id="card_fill" autocomplete="off">
            <label class="btn btn-secondary" for="card_fill">С карты</label>


            <div class="check_fill mt-3">
                <div class="input-group">
                    <select name="check_fill" class="form-select" aria-label="Default select example">
                        <option value="null" selected>Выбор счёта</option>
                        <?php require_once "./server/refill_check.php" ?>
                    </select>
                </div>
            </div>

            <div class="card_fill mt-3">
                <div class="input-group">
                    <select name="card_fill" class="form-select" aria-label="Default select example">
                        <option value="null" selected>Выбор карты</option>
                        <?php require_once "./server/refill_card.php" ?>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                На карту:

                <select class="form-select mt-3" aria-label="Disabled select example" disabled>
                    <option selected><?= substr($this_card, 0, 4), "****", substr($this_card, 12, 15) ?></option>
                </select>
            </div>
            <div class="row mt-5 mb-5 justify-content-md-center text-center">
                <div class="form-control col rounded border bg-light border-2 pa-col">
                    <h3 class="d-grid gap-2 d-md-flex justify-content-md-center">Подтверждение</h3>

                    <input class="form-control mt-5 mb-2" type="text" name="count" placeholder="Сумма пополнения" required="" />
                    <input class="form-control mt-3 mb-2" type="text" name="password" placeholder="Пароль" required="" />
                    <input type="hidden" value="<?= $this_card ?>" name="dest_number" />
                    <input type="hidden" value="<?= $_GET['id'] ?>" name="id" />
                    <div class="d-grid">
                        <button type="submit" name="sub" class="btn btn-primary mt-4">Отправить перевод</button>
                    </div>
        </form>
    </div>
    </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>