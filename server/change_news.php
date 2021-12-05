<?php
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set( 'upload_max_size' , '12M' );
  ini_set( 'post_max_size', '12M');
  ini_set( 'max_execution_time', '150' );
  require "config.php";
  $tittle=$_POST["tittle"];
  $d=$_POST["n_id"];
  $intro_text=$_POST["intro_text"]; 
  $full_text=$_POST["full_text"];
  $login=isset($_SESSION['login']);
  $log=print_r($login);
  global $db;
  $sql="UPDATE `news` SET tittle='$tittle'  ,intro_text='$intro_text' , full_text='$full_text' WHERE id='$d' "; 
  $res=mysqli_query($db,$sql);
  if ($res==TRUE) {
                  echo "<h1>";
                  echo "Данные отредактированны";
                  echo "</h1>";
                  header('Location: /index.php');
              }  
   else {
                    echo "<h1>";
                    echo "Произошла ошибка  соединения с бд";
                    echo "</h1>";
            }

                ?>

