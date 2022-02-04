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
        <a href="/pay.php">Назад</a>
        <div style="text-align: center;">
            <h3 class="newnews mb-5">Создание шаблона</h3>
        </div>

        <form action="/server/templates_transit.php" method="post">

            <input type="text" name="template_name" class="form-control mt-3 mb-4" placeholder="Имя шаблона" aria-label="Имя шаблона" aria-describedby="addon-wrapping">

            <input type="radio" class="btn-check" name="radio" id="check_fill" autocomplete="off" checked>
            <label class="btn btn-secondary" for="check_fill">Со счёта</label>
            <input type="radio" class="btn-check" name="radio" id="card_fill" autocomplete="off">
            <label class="btn btn-secondary" for="card_fill">С карты</label>



            <div class="check_fill mt-3">
                <div class="input-group">
                    <select name="check_fill" class="form-select" aria-label="Default select example" onchange='findOptionCheck(this)'>
                        <option value="null" selected>Выбор счёта</option>
                        <?php require_once "./server/refill_check.php" ?>
                    </select>
                </div>
                <script>
                    document.getElementById('card_item2').disabled = true;
                    var source_card = "null";
                    var source_check = "null";

                    function findOptionCheck(select) {
                        var source_check = select.querySelector(`option[value="${select.value}"]`);
                        console.log(source_check.value);
                        if (source_check.value !== "null") {
                            document.getElementById('card_fill').disabled = true;
                            document.getElementById('card_item').style.display = "Block";
                        } else {
                            document.getElementById('card_item2').disabled = true;
                            document.getElementById('card_fill').disabled = false;
                            document.getElementById('card_item').style.display = "None";
                        }
                    }
                </script>
            </div>

            <div class="card_fill mt-3">
                <div class="input-group">
                    <select name="card_fill" id='card_fill_sel' class="form-select" aria-label="Default select example" onchange='findOptionCard(this)'>
                        <option value="null" selected>Выбор карты</option>
                        <?php require_once "./server/refill_card.php" ?>
                    </select>
                </div>
                <script>
                    function findOptionCard(select) {
                        var source_card = select.querySelector(`option[value="${select.value}"]`);
                        console.log(source_card.value);
                        if (source_card.value !== "null") {

                            document.getElementById('check_fill').disabled = true;
                            document.getElementById('card_item').style.display = "Block";
                            document.getElementById('card_item1').style.display = "Block";
                        } else {
                            document.getElementById('card_item2').disabled = true;
                            document.getElementById('check_fill').disabled = false;
                            document.getElementById('card_item').style.display = "None";
                            document.getElementById('card_item1').style.display = "None";
                        }
                    }
                    
                </script>
            </div>
            <div class="mt-4" id="card_item" style='display: none'>
                На карту:

                <select name="dest_card" class="form-select mt-3" id="card_item4" aria-label="Disabled select example" onchange='findOptionCard1(this)'>
                    <option value="null" selected>Выбор карты</option>
                    <?php require_once "./server/refill_card_templates.php" ?>
                </select>
            </div>
            <script>
                function findOptionCard1(select) {
                    var source_card1 = select.querySelector(`option[value="${select.value}"]`);
                    console.log(source_card1.value);
                    if (source_card1.value !== "null") {
                        document.getElementById('card_item1').disabled = true;
                        document.getElementById('card_item3').disabled = true;
                        document.getElementById('card_item2').disabled = false;
                    } else {
                        document.getElementById('card_item1').disabled = false;
                        document.getElementById('card_item3').disabled = false;
                        document.getElementById('card_item2').disabled = true;
                    }
                }
            </script>
            <div class="mt-4" id="card_item1" style='display: none'>
                Платёж:
                <select id="card_item3" name="dest_pay" class="form-select mt-3" aria-label="Disabled select example" onchange='findOptionCard2(this)'>
                    <option value="null" selected>Выбор платежа</option>
                    <?php require_once "./server/templates_pay_list.php" ?>
                </select>
                <script>
                    function findOptionCard2(select) {
                        var source_card2 = select.querySelector(`option[value="${select.value}"]`);
                        console.log(source_card2.value);
                        if (source_card2.value !== "null") {
                            document.getElementById('card_item').disabled = true;
                            document.getElementById('card_item4').disabled = true;
                            document.getElementById('card_item2').disabled = false;
                        } else {
                            document.getElementById('card_item').disabled = false;
                            document.getElementById('card_item4').disabled = false;
                            document.getElementById('card_item2').disabled = true;
                        }
                    }
                </script>
            </div>

            <div class="row mt-5 mb-5 justify-content-md-center text-center">
                <div class="form-control col rounded border bg-light border-2 pa-col">
                    <h3 class="d-grid gap-2 d-md-flex justify-content-md-center">Подтверждение</h3>

                    <input class="form-control mt-5 mb-2" type="number" name="count" placeholder="Сумма пополнения" required="" />
                    <input class="form-control mt-3 mb-2" type="password" name="password" placeholder="Пароль" required="" />
                    <div class="d-grid">
                        <button type="submit" name="sub" id="card_item2" class="btn btn-primary mt-4" disabled>Создать шаблон</button>
                    </div>
        </form>
    </div>
    </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>