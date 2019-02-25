<?php
  include('bd.php');
  session_start();

  if(empty($_POST['login']) || empty($_POST['password']))
  {
    exit("Error");
  }
  else {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $result = mysql_query("SELECT * FROM user WHERE login='$login'",$db);
    $res = mysql_fetch_array($result);
    if(empty($res['password']))
    {
      exit("Error");
    }
    else
    {
      if($res['password'] == $password)
      {
        switch ($res['id'])
        {
          case '1':
          $_SESSION['id'] = 1;
            header("Location: /admin.php");
            exit;
            break;
          case '2':
          $_SESSION['id'] = 2;
            header("Location: /flight.php");
            exit;
        }
      }
      else
      {
        exit("error");
      }
    }
  }

 ?>
