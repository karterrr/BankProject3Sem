<ul class="pagination justify-content-center mt-3">

    <?php
    if ($_GET['page']>$responseDatacheck->data->countPage)
    {
        header("Location:/check_main_info.php?id=".$_GET['id']."&page=1");
    }
    if ($responseDatacheck->data->countPage > 1) {

        if ($_GET['page'] == 1) {
    ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Предыдущая</a>
            </li>
        <?php
        } else {
        ?>
            <li class="page-item">
                <a class="page-link" href="/check_main_info.php?id=<?=$_GET['id']?>&page=<?=$_GET['page']-1?>" tabindex="-1" aria-disabled="true">Предыдущая</a>
            </li>
            <?php
        }
        $m = 1;

        while ($m <= $responseDatacheck->data->countPage) {
            if ($m == $_GET['page']) {
            ?>
                <li class="page-item active"><a class="page-link" href=""><?= $m ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" href="/check_main_info.php?id=<?=$_GET['id']?>&page=<?=$m?>"><?= $m ?></a></li>
        <?php
            }
            $m = $m + 1;
        }
        if ($_GET['page'] == $responseDatacheck->data->countPage) {
        ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Следующая</a>
            </li>
        <?php
        } else {
        ?>
            <li class="page-item">
                <a class="page-link" href="/check_main_info.php?id=<?=$_GET['id']?>&page=<?=$_GET['page']+1?>">Следующая</a>
            </li>
    <?php
        }
    }
    ?>
</ul>