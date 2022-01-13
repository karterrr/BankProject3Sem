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
    $url = "http://lightfire.duckdns.org/getcards";
    ?>



    <?php
    $data = array(
        'token' => $_SESSION['id'],
    );

    $options = stream_context_create(array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n",
        )
    ));


    $response = file_get_contents($url, FALSE, $options);
    // Check for errors
    if ($response === FALSE) {
        print "ошибка";
    }

    //var_dump($response);

    // Decode the response
    $responseData = json_decode($response);

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
    }

    ?>
    <div class="container mt-5">
        <a href="/index.php">На главную</a>
        <div class="card_border mt-5">
            <div class="form-control col rounded border bg-light border-2 mb-5 w-50 h-auto mx-auto pa-col">
                <h2 class="h3 mt-5 ps-5"><?= $array[$i]->name ?> </h2>
                <h3 class="h4 mt-4 ps-5"><?= $array[$i]->number ?></h3>
                <h3 class="mt-5 mb-5 ps-5"><?= $array[$i]->count ?></h3>
            </div>
        </div>
        <?php
        if ($array[$i]->is_blocked == TRUE) {
        ?>
            <h3 class="h4 d-grid gap-2 d-md-flex justify-content-md-center">КАРТА ЗАБЛОКИРОВАНА</h3>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-5">
                <button type="button" class="btn btn-danger me-md-5" disabled>Пополнить</button>
                <button type="button" class="btn btn-success" disabled>Перевести</button>
            </div>
        <?php
        } else {
        ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-5">
                <button type="button" class="btn btn-danger me-md-5" onclick="window.click_refill(<?php echo $array[$i]->id ?>);">Пополнить</button>
                <script>
                    function click_refill(c) {
                        console.log(c);
                        location.href = "./refill.php?id=" + c;
                    }
                </script>
                <button type="button" class="btn btn-success" onclick="window.click_transit(<?php echo $array[$i]->id ?>);">Перевести</button>
                <script>
                    function click_transit(d) {
                        console.log(d);
                        location.href = "./transit.php?id=" + d;
                    }
                </script>
            </div>
        <?php
        }
        if ($array[$i]->is_blocked == FALSE) {
        ?>
            <div class="row mt-5 mb-5 justify-content-md-center text-center">
                <div class="form-control col rounded border bg-light border-2 pa-col">
                    <h3>Заблокировать карту</h3>
                    <form action="/server/block_card.php" method="post">
                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id" />
                        <input type="hidden" value="<?= $array[$i]->number ?>" name="number" />
                        <input class="form-control mt-5 mb-2" type="text" name="password" placeholder="Ваш пароль" required="" />
                        <div class="d-grid">
                            <button type="submit" name="sub" class="btn btn-primary mt-4 ">Заблокировать</button>
                        </div>
                    </form>


                </div>
                <div class="form-control col rounded border bg-light border-2 pa-col">
                    <h3 class="d-grid gap-2 d-md-flex justify-content-md-center">Переименовать</h3>
                    <form action="/server/change_card_name.php" method="post">
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
                            <th colspan="3" class="table_name"><a target="_blank">История по карте</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="col3">
                            <th>Тип операции</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                        </tr>
                        <?php require "./server/card_history_main.php" ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- test -->
    <?php require "blocks/footer.php" ?>
</body>

</html>