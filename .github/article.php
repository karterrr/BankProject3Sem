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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Gachi Bank</title>
</head>
<body>
    <?php require "blocks/header.php" ?>
    <?php  
    require "server/config.php" ;
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    global $db;
    if (isset($_GET['id_n'])){
        $d=  $_GET["id_n"];
        $_SESSION['ARTICLES_DATA']=$d;
    }
    else{
        $d=$_SESSION['ARTICLES_DATA'];
    }
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
        <h3 class="text-center newnews mb-5"><?php echo $tittle?></h3>
        <div class="" style="margin-left: 1%;">
            <h6 class="float-right">Дата публикации: <?php print(date('d.m.Y',strtotime($date))); ?></h6>
            <!-- ТУТ ГОД И АВТОРА НОРМ ВЫВОДИТЬ -->
        </div>

        <div class="row">
            <div class="col media">
                <a class="p-3 pull-left"> <img src="news_img/<?php print_r($news['img_id']); ?>.jpg" class=" img-thumbnail media-object" width="300" alt=""></a>
                <div class="media-body">
                    <p>
                    <?php echo $full_text?>
                    </p>
                </div>
            </div>
        </div>

        <?php  if(isset($_SESSION['id']))
        {
            
            if($_SESSION['root']==1)
            {
            ?><form action="server/article_change.php" method="post">
            <button id="id_n_c"  name="id_n_c" value=<?php echo $d;?>  class="btn btn-outline-info">
            <img src="sys_img/pen.png" width="40">
            </form>
            
        </button>

                <?php
            }
                
        }?>
        
    <!-- Прикрутить к этой кнопке редактор текста и сделать недоступной для простолюдинов -->
    

    <section class="content-item mt-4" id="comments">
    <div class="container">   
    	<div class="row">
            <div class="col-sm-8"> 
                <?php
                if(isset($_SESSION['id']) and $_SESSION['root']!=2)
                {
                ?>      
                <form action="server/add_com.php"method="post"> 
                	<h3 class="pull-left">Новый коментарий</h3>
                
                	<button type="submit" class="btn btn-primary pull-right"  id="id_c"  name="id_c"
                     value=<?php print_r($d); ?> >Отправить</button>
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-3 col-lg-2 hidden-xs">

                                <?php 
                                if($_SESSION['img']=='')
                                {
                                    ?>
                            	    <img src="../img/upload_def_icon.jpg" class="user-img-com rounded-circle img-thumbnail">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <img src="../<?php echo $_SESSION['img']; ?>" class="user-img-com rounded-circle img-thumbnail">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                
                                <textarea class="form-control" id="message" name="message" placeholder="Ваше сообщение" required=""></textarea>
                            </div>
                        </div>  	   
                    </fieldset>
                </form>
                <?php
                }
                ?>
                <?php  require "server/config.php";
                 global $db;
                $res = $db->query("SELECT count(*) FROM  comments WHERE id_news=$d");
                        $row = $res->fetch_row();
                        $r=mysqli_query($db,"SELECT * FROM `comments`WHERE id_news=$d ORDER BY id DESC");       ?> 
                <h3>Комментарии:</h3>
                <!-- количество коментов, можно есчо просто удалить -->
                <?php while ($com= mysqli_fetch_assoc($r)) { 
                        $result_c=mysqli_query($db,"SELECT * FROM `users_attribute` WHERE login=$name_users");
                        $author=mysqli_fetch_assoc($result_c);
                        $comment_img_search = $com['name_users'];
                        $res_img=mysqli_query($db,"SELECT * FROM `users_attribute` WHERE login=$comment_img_search ");
                        $img_user=mysqli_fetch_assoc($res_img);
                ?>
               <!-- COMMENT 1 - START -->
               <?php
               if($img_user['root']!=2)
               {
                   ?>
                    <div class="media">
                        <?php
                        if($img_user['img']=='')
                        {
                            ?>
                            <a class="pull-left"><img src="../img/upload_def_icon.jpg" class="user-img rounded-circle img-thumbnail" width="200"></a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a class="pull-left"><img src="../<?php echo $img_user['img']; ?>" class="user-img rounded-circle img-thumbnail" width="200"></a>
                            <?php
                        }
                        ?>
                        <!-- АВА ПОЛЬЗОВАТЕЛЯ -->
                        <div class="media-body">
                            <h4 class="media-heading"><?php print_r($com['name_users']); ?></h4>
                            <p><?php print_r($com['text']); ?></p>
                            <!-- текст комента -->
                            <ul class="list-unstyled list-inline media-detail pull-left">
                                <li><i class="fa fa-calendar"></i><?php print(date('d.m.Y',strtotime($com['date']))); ?></li>
                                <!-- дата камента -->
                            </ul>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- COMMENT 1 - END -->
                <?php }?>
            
            </div>
        </div>
    </div>
</section>

    <?php require "blocks/footer.php" ?>
</body>
</html>