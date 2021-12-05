
<?php 
//  ini_set('error_reporting', E_ALL);
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
session_start();
require "config.php";
    if($_SESSION['root']==1 && isset($_SESSION['id']))
    {
?>
<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
        <title>News Today</title>
    </head>
    <body>
        <?php require "../blocks/header.php" ?>
        <?php  
                global $db;
                ini_set('error_reporting', E_ALL);
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                require "config.php";
                $d=  $_POST["id_n_c"];
                $query=mysqli_query($db, "SELECT * FROM `news` WHERE `id`='$d' ");
                $news=mysqli_fetch_assoc($query);
                $tittle=$news['tittle'];
                $intro_text=$news['intro_text'];
                $date=$news['date'];
                $full_text=$news['full_text'];
                $name_users=$news['name_users'];
                $img_id=$news['img_id'];
    
    ?>
        <div class="container mt-5">
            <form action="change_news.php "enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="article-pic">Картинка статьи:</label>
                        <img src="../news_img/<?php print_r($news['img_id']);?>.jpg" width="20%"> 
                    <!--     <div>
                            <input type="file"  name="image_t"> пока не будем редачить фото
                            При выборе файла выбранная картинка должна появиться вместо деф пикчи 
                        </div>-->
                    </div>
                    <div class="form-group mt-5">
                        <label for="desc">ID Новости:</label>
                        <textarea class="form-control" readonly id="n_id" type="text"  name="n_id"><?php echo $d?></textarea>
                    </div>
                    <div class="form-group mt-5">
                        <label for="heading">Заголовок:</label>
                        <?php echo'<input class="form-control" required  type="text" id="tittle" name="tittle" value ="';
                         echo $tittle;echo'"'?>;
                    </div>  
                    <div class="form-group mt-5">
                        <label for="desc">Краткое описание:</label>
                        <textarea class="form-control" required id="desc" type="text"  name="intro_text"><?php echo $intro_text?></textarea>
                    </div>
                    <div class="form-group mt-5">
                        <label for="article">Статья:</label>
                        <textarea class="form-control" type="text"  required id="full_text" name="full_text"><?php echo $full_text?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    <!-- После нажатия все данные с форм отправляются там куда-то вам и после должны на главной появиться -->
                
            </form>
        </div>
        <?php require "../blocks/footer.php" ?>
    </body>
    </html>   

<?php
    }
    else
    {
        header("Location:index.php");    
    }            
?>
