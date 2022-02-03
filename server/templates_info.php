<?php
session_start();

require_once "config.php";
require_once "utils.php";

$data = array(
    'token' => $_SESSION['id'],
    'id' => null
);

$responseData = api_call($api_url . "/templates/get", "POST", $data);

$array = $responseData->data;
//var_dump($array[0]);
$i = -1;
if ($responseData->success === TRUE) {
    while ($i < count($array)) {
        if ($i == -1) {
?>
            <tbody onclick="window.click_new_template('x');">
                <tr class="col2">
                    <td align="left" colspan="2"><?php echo "Создать новый шаблон" ?></td>
                </tr>
            </tbody>
            <script>
                function click_new_template(x) {
                    console.log(x);
                    location.href = "templates_new.php";
                }
            </script>
        <?php
            $i = $i + 1;
        } else {
        ?>
            <form action="/server/template_delete.php" method="post">
                <tbody onclick="window.click_templates(<?php echo $array[$i]->id ?>);">
                    <tr class="col2">
                        <td align="left"><?php echo $array[$i]->name ?></td>
                        <td align="right"><button type="submit" name="sub" class="btn btn-danger">Удалить</button></td>
                        <input type="hidden" value="<?=$array[$i]->id  ?>" name="id" />
                    </tr>
                </tbody>
            </form>
            <script>
                function click_templates(rh) {
                    console.log(rh);
                    location.href = "./templates_main_info.php?id=" + rh;
                }
            </script>
<?php
            $i = $i + 1;
        }
    }
}
?>