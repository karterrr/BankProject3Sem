<?php

session_start();

require "config.php";

if (isset($_SESSION['id'])) {
    if (isset($_POST['sub'])) {

        if (isset($_POST['count'])) {
            $count = $_POST['count'];
            if ($count == '') {
                unset($count);
            }
        } //заносим введенный пользователем логин в переменную $new_login, если он пустой, то уничтожаем переменную

        //print $email." ".$password;
        if (empty($_POST['bank_number']) or empty($_POST['card_pay'])) //если пользователь не ввел логин, то выдаем ошибку и останавливаем скрипт
        {
            header("Location:/pay.php?id=" . $_POST['id']);
        }

        if ($_SESSION['password'] != $_POST['password']) {
            header("Location:/pay.php?id=" . $_POST['id']);
        }



        //$password=$_SESSION['password'];
        //$login=$_SESSION['login'];




        if ($_POST['card_pay']) {
            $source = $_POST['card_pay'];
        }

        $urlcategiry = "http://lightfire.duckdns.org/category";

        $datacategory = array();

        $optionscategory = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($datacategory),
                'header' =>  "Content-Type: application/json\r\n",
            )
        ));


        $responsecategory = file_get_contents($urlcategiry, FALSE, $optionscategory);
        // Check for errors
        if ($responsecategory == FALSE) {
            print "ошибка";
        }

        $responseDatacategory = json_decode($responsecategory);

        $arraycategory = $responseDatacategory->data;
        //var_dump($array[0]);
        $e = 0;
        if ($responseDatacategory->success === TRUE) {
            while ($e < count($arraycategory)) {
                if($_POST['id']==$arraycategory[$e]->id)
                {
                    $dest=$arraycategory[$e]->name;
                }
                $e = $e + 1;
            }
        }
        


        $url = "http://lightfire.duckdns.org/refill";


        $data = array(
            'token' => $_SESSION['id'],
            'source' => $source,
            'dest' => $dest,
            'sum' => (int)$_POST['count'],
            'payType' => 2
        );

        var_dump($data);

        $options = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($data),
                'header' =>  "Content-Type: application/json\r\n",
            )
        ));

        $response = file_get_contents($url, FALSE, $options);
        // Check for errors
        var_dump($response);
        if ($response == FALSE) {
            print "ошибка";
        }

        //var_dump($response);

        // Decode the response
        $responseData = json_decode($response);

        //var_dump($responseData);
        if ($responseData == TRUE) {
            header("Location:/pay.php");
            //print ("work");
        } else {
            echo "Ошибка! Пароль не изменён";
        }
    } else {
        header("Location:/index.php");
    }
} else {
    header("Location:/index.php");
}
