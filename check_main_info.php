<?php
session_start();
require_once "server/config.php";
require_once "server/utils.php";
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
    $data = array(
        'token' => $_SESSION['id'],
    );

    $responseData = api_call($api_url . "/getcheck", "POST", $data);

    $array = $responseData->data;
    //var_dump($array[0]);
    $i = 0;
    if ($responseData->success === TRUE) {
        while ($i < count($array)) {
            if ($_GET['id'] == $array[$i]->id) {
                //$card_number=$array[$i]->number;
                //$card_count=$array[$i]->count;
                //$card_blocked = $array[$i]->is_blocked;
                break;
            }

            $i = $i + 1;
        }
        if ($_GET['id'] != $array[$i]->id) {
            header("Location:index.php");
        }
    }

    ?>
    <div class="container mt-5">
        <a href="/index.php">На главную</a>
        <div class="card_border mt-5">
            <div class="form-control_card col rounded border bg-light border-2 mb-5 w-50 h-auto mx-auto pa-col">
                <h2 class="h3 mt-4 ps-5"><?php if (($array[$i]->name) != "") {
                                                echo $array[$i]->name;
                                            } else print "Текущий счёт"  ?> </h2>
                <h3 class="mt-5 mb-5 pe-5 text-end"><?= $array[$i]->count, " руб." ?></h3>
                <h3 class="h4 mb-4 ps-5"><?= $array[$i]->number ?></h3>
            </div>
        </div>
        <div class="row mt-5 mb-5 justify-content-md-center text-center">
            <div class="form-control col rounded border bg-light border-2 pa-col">
                <h3 class="d-grid gap-2 d-md-flex justify-content-md-center">Переименовать</h3>
                <form action="/server/change_check_name.php" method="post">
                    <input class="form-control mt-5 mb-2" type="text" name="new_name" placeholder="Новое имя" required="" />
                    <input type="hidden" value="<?= $array[$i]->number ?>" name="number" />
                    <input type="hidden" value="<?= $_GET['id'] ?>" name="id" />
                    <div class="d-grid">
                        <button type="submit" name="sub" class="btn btn-primary mt-4">Изменить имя</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- к этой кнопеке надо прикрутить проверку на админа хз как -->
        <div class="inlineBlock">
            <table class="informer_table">
                <thead>
                    <tr>
                        <th colspan="3" class="table_name"><a target="_blank">История по счёту</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="col3">
                        <th>Тип операции</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                    </tr>
                    <?php require_once "./server/check_history_main.php" ?>
                </tbody>
            </table>

            <nav aria-label="check_history">
                <?php require "./server/check_history_pagination.php" ?>
            </nav>

        </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>