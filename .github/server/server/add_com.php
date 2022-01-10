<?php
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set( 'upload_max_size' , '12M' );
  ini_set( 'post_max_size', '12M');
  ini_set( 'max_execution_time', '150' );
  require "config.php";
  global $db;
  $id_c=$_POST["id_c"];
  $full_text=$_POST["message"];
  session_start();
  $login=$_SESSION['login'];
global $db;
if (! $login){
  $login="Гость";
}
$sql="INSERT INTO `comments` (`name_users`,`id_news`,`text`,`date`) 
                VALUES ('$login','$id_c','$full_text',now())";
                $res=mysqli_query($db,$sql);
                if ($res==TRUE) {
                  header("Location: /article.php");
              }  
                  else {
                    echo "<h1>";
                    echo "Произошла ошибка  соединения с бд";
                    echo "</h1>";
            } 

                
                ?>

