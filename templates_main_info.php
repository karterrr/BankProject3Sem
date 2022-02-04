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
    ?>
    <div class="container mt-5">
        <a href="/pay.php">Назад</a>
        <?php
        $datat = array(
            'token' => $_SESSION['id'],
            'id' => $_GET['id']
        );

        $responseDatat = api_call($api_url . "/templates/get", "POST", $datat);
        $arrayTempl = $responseDatat->data;
        ?>
        <div style="text-align: center;">
            <h3 class="newnews mb-5"><?= $arrayTempl[0]->name ?></h3>
        </div>



        <div class="card_transit mt-4">
            <?php
            if ($arrayTempl[0]->source_type == 0) { ?>
                С карты:
                <input class="form-control mt-3 mb-4" type="text" name="card_transit" value="<?= substr($arrayTempl[0]->source, 0, 4), "****", substr($arrayTempl[0]->source, 12, 15) ?>" required="" disabled />
            <?php
            } elseif ($arrayTempl[0]->source_type == 1) { ?>
                С счёта:
                <input class="form-control mt-3 mb-4" type="text" name="card_transit" value="<?= "****", substr($arrayTempl[0]->source, 4, 12) ?>" required="" disabled />
            <?php
            }
            ?>
        </div>


        <div class="mt-3">
            <?php
            if ($arrayTempl[0]->dest_type == 0) { ?>
                На карту:
                <input class="form-control mt-3 mb-4" type="text" name="card_transit" value="<?= substr($arrayTempl[0]->dest, 0, 4), "****", substr($arrayTempl[0]->dest, 12, 15) ?>" required="" disabled />
            <?php
            } elseif ($arrayTempl[0]->dest_type == 2) { ?>
                Платёж:
                <input class="form-control mt-3 mb-4" type="text" name="card_transit" value="<?= $arrayTempl[0]->dest ?>" required="" disabled />
            <?php
            } elseif ($arrayTempl[0]->dest_type == 1) { ?>
                На счёт:
                <input class="form-control mt-3 mb-4" type="text" name="card_transit" value="<?= "****", substr($arrayTempl[0]->dest, 4, 12) ?>" required="" disabled />
            <?php
            }
            ?>
        </div>

        <div class="row mt-5 mb-5 justify-content-md-center text-center">

            <div class="row mt-5 mb-5 justify-content-md-center text-center">
                <div class="form-control col rounded border bg-light border-2 pa-col">
                    <h3 class="d-grid gap-2 d-md-flex justify-content-md-center">Подтверждение</h3>
                    <form action="/server/transit_template.php" method="post">
                        <input class="form-control mt-5 mb-2" type="number" value="Сумма: <?= $arrayTempl[0]->sum ?> руб." required="" disabled />
                        <input class="form-control mt-3 mb-2" type="password" name="password" placeholder="Пароль" required="" />
                        <input type="hidden" value="<?=$arrayTempl[0]->source ?>" name="source_number" />
                        <input type="hidden" value="<?=$arrayTempl[0]->dest ?>" name="dest_number" />
                        <input type="hidden" value="<?=$arrayTempl[0]->sum ?>" name="count" />
                        <input type="hidden" value="<?=$arrayTempl[0]->source_type ?>" name="source_type" />
                        <input type="hidden" value="<?=$arrayTempl[0]->dest_type ?>" name="dest_type" />
                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id" />
                        <div class="d-grid">
                            <button type="submit" name="sub" class="btn btn-primary mt-4">Отправить перевод</button>
                        </div>
                    </form>

                </div>
                

            </div>
        </div>
    </div>
    <!-- test -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>