<?php 
    require_once "config.php";
   
 function get_news (){
     global $db;
     $result=mysqli_query($db,"SELECT * FROM `news` ORDER BY id DESC");
     return $result;
 }
?>