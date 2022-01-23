  <?php
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  require_once "config.php";
  global $db;
  $tittle=$_POST["tittle"];
  $intro_text=$_POST["intro_text"]; 
  $full_text=$_POST["full_text"];
  $login=isset($_SESSION['login']);
  $res = $db->query("SELECT count(*) FROM news");
  $row = $res->fetch_row();
  $img_id = $row[0];
  $img_id=$img_id+1;
   global $name_f_f;
  function chk($img_id)
  {
      /*$size = 1024000;

      if ($_FILES['image_t']['size'] > $size)
      {
          echo 'Давай файл поменьше';
        
      }
      else
      {
         global  $name_f_f ;  
         $name_f_f = mt_rand(0, 10000) . $_FILES['image_t']['name'];
          if(copy($_FILES['image_t']['tmp_name'], '../news_img/.'+$name_f_f ))
          {
              return True;
          }
       }
        return FALSE;  
  echo "Ошибка! Фото не добавлено"*/



           $uploaddir = '../news_img/';
              // это папка, в которую будет загружаться картинка
              $apend=$img_id.".jpg";
              // это имя, которое будет присвоенно изображению 
              $uploadfile = "$uploaddir$apend"; 

         echo  $uploadfile;
              if (copy($_FILES['image_t']['tmp_name'], $uploadfile)) 
              {
                  // header("Location: /index.php")
                  echo "Файл корректен и был успешно загружен.\n";
                  return TRUE;
              } else {
                  echo "Возможная атака с помощью файловой загрузки!\n";
                  echo  $uploadfile;
              }
              //в переменную $uploadfile будет входить папка и имя изображения
            return FALSE;
}          
  if (chk($img_id)==TRUE){
            $log=print_r($login);
            global $db;
            global $img_id;
            global $name_f_f;
            $sql="INSERT INTO `news` (`date` ,`intro_text`, `full_text`,`tittle`,`name_users`,`img_id`) 
                VALUES (now(),'$intro_text', '$full_text','$tittle','$log','$img_id')";
                $res=mysqli_query($db,$sql);
                if ($res==TRUE) {
                //  header("Location: /index.php");
                  echo "<h1>";
                  echo "Данные добавлены";
                  echo "</h1>";
                  header('Location: /index.php');
              }  
                  else {
                    echo "<h1>";
                    echo "Произошла ошибка  соединения с бд";
                    echo "</h1>";
            }}  
          else{
            echo "<h1>";
            echo "Файл не подходит под условие";
            echo "</h1>";
          }        
                
                ?>

